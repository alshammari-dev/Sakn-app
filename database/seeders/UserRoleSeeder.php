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
        $password = Hash::make('12341234'); 

        
        foreach (range(1, 5) as $index) {
            $agent = User::create([
                'name' => $faker->name,
                'email' => "agent{$index}@test.com", 
                'password' => $password,
            ]);
            
            
            $agent->assignRole('sale-agent'); 
        }

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