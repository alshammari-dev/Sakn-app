<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FavoriteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clients = \App\Models\User::role('client')->get();
        $properties = \App\Models\Property::all();

        if ($clients->isEmpty() || $properties->isEmpty()) {
            return;
        }

        foreach ($clients as $client) {
            // Each client favorites 1-2 random properties
            $randomProperties = $properties->random(rand(1, 2));
            foreach ($randomProperties as $property) {
                \App\Models\Favorite::create([
                    'client_id'   => $client->id,
                    'property_id' => $property->id,
                ]);
            }
        }
    }
}
