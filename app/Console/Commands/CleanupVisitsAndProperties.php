<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use App\Models\Visit;
use App\Models\Property;
use Carbon\Carbon;

#[Signature('app:cleanup-visits-and-properties')]
#[Description('Command description')]
class CleanupVisitsAndProperties extends Command
{
    /**
     * Execute the console command.
     */

    protected $signature = 'sakn:cleanup'; // اسم الأمر اللي راح يشغله السيرفر
    protected $description = 'تنظيف الزيارات القديمة وإعادة العقارات المعلقة للحالة متاح';
    public function handle()
    {
        $expiredVisits = Visit::where('status', 'pending')
            ->where('scheduled_at', '<', now())
            ->update(['status' => 'cancelled']);

        $this->info("تم إلغاء $expiredVisits زيارة منتهية الوقت.");

        // 2. تنظيف العقارات: أي عقار تحت التفاوض مر عليه 48 ساعة من آخر زيارة مكتملة
        // ولم يدفع له عربون (Reserved)
        $propertiesToRelease = Property::where('status', 'under_negotiation')
            ->whereDoesntHave('deposits', function($query) {
                $query->whereIn('status', ['approved', 'completed']);
            })
            ->whereHas('visits', function($query) {
                $query->where('status', 'completed')
                      ->where('updated_at', '<', now()->subHours(48));
            })->get();

        foreach ($propertiesToRelease as $property) {
            $property->update(['status' => 'available']);
        }

        $this->info("تمت إعادة " . $propertiesToRelease->count() . " عقار إلى الحالة متاح.");
    }
}
