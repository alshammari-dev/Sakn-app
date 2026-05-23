<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $password = Hash::make('12341234'); // كلمة المرور الموحدة

        // --- إنشاء 5 وكلاء مبيعات (Sales Agents) ---
        foreach (range(1, 5) as $index) {
            $agent = User::create([
                'name' => $faker->name,
                'email' => "agent{$index}@test.com", // بريد إلكتروني تسلسلي لسهولة الحفظ
                'password' => $password,
            ]);
            
            // تعيين دور الوكيل (تأكد من مطابقة الاسم لما هو موجود في قاعدة بياناتك)
            $agent->assignRole('sale-agent'); 
        }

        // --- إنشاء 10 عملاء (Clients) ---
        foreach (range(1, 10) as $index) {
            $client = User::create([
                'name' => $faker->name,
                'email' => "client{$index}@test.com",
                'password' => $password,
            ]);
            
            // تعيين دور العميل
            $client->assignRole('client');
        }
    }
}
