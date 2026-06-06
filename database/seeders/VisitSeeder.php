<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Visit;
use App\Models\Property;
use App\Models\User;
use Carbon\Carbon;

class VisitSeeder extends Seeder
{
    public function run()
    {
        
        $propertyIds = Property::pluck('id')->toArray();
        $agentIds = User::role('sale-agent')->pluck('id')->toArray();
        $clientIds = User::role('client')->pluck('id')->toArray();

        foreach (range(1, 15) as $index) {
            Visit::create([
                'property_id'  => $propertyIds[array_rand($propertyIds)],
                'client_id'    => $clientIds[array_rand($clientIds)],
                'agent_id'     => $agentIds[array_rand($agentIds)],
                'scheduled_at' => Carbon::now()->addDays(rand(1, 10))->addHours(rand(1, 12)),
                'status'       => ['pending', 'approved', 'completed', 'cancelled'][rand(0, 3)],
                'notes'        => 'Fake message for the visit ' . $index,
            ]);
        }
    }
}