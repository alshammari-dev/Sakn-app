<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = \App\Models\User::where('email', 'admin@test.com')->first();
        $contentManager = \App\Models\User::where('email', 'content@test.com')->first();
        
        $creatorId = $contentManager ? $contentManager->id : ($admin ? $admin->id : 1);

        $properties = [
            [
                'title' => 'Luxury Villa in Riyadh',
                'ai_description' => 'A beautiful luxury villa with 5 bedrooms and a private pool.',
                'price' => 2500000.00,
                'city' => 'Riyadh',
                'district' => 'Al-Malqa',
                'lat' => 24.7136,
                'lng' => 46.6753,
                'status' => 'available',
                'is_archived' => 0,
                'added_by' => $creatorId,
            ],
            [
                'title' => 'Modern Apartment in Jeddah',
                'ai_description' => 'Spacious 3-bedroom apartment with sea view.',
                'price' => 850000.00,
                'city' => 'Jeddah',
                'district' => 'Al-Shati',
                'lat' => 21.5433,
                'lng' => 39.1728,
                'status' => 'available',
                'is_archived' => 0,
                'added_by' => $creatorId,
            ],
            [
                'title' => 'Cozy Studio in Dammam',
                'ai_description' => 'Perfect for young professionals, close to the corniche.',
                'price' => 350000.00,
                'city' => 'Dammam',
                'district' => 'Al-Mazruiyah',
                'lat' => 26.4207,
                'lng' => 50.0888,
                'status' => 'under_negotiation',
                'is_archived' => 0,
                'added_by' => $creatorId,
            ],
            [
                'title' => 'Family House in Khobar',
                'ai_description' => 'Large garden and 4 bedrooms in a quiet neighborhood.',
                'price' => 1200000.00,
                'city' => 'Khobar',
                'district' => 'Al-Hizam Al-Thahabi',
                'lat' => 26.2886,
                'lng' => 50.2108,
                'status' => 'available',
                'is_archived' => 0,
                'added_by' => $creatorId,
            ],
            [
                'title' => 'Traditional House in Diriyah',
                'ai_description' => 'Beautifully restored traditional mud house.',
                'price' => 1800000.00,
                'city' => 'Riyadh',
                'district' => 'Diriyah',
                'lat' => 24.7335,
                'lng' => 46.5411,
                'status' => 'available',
                'added_by' => $creatorId,
            ],
        ];

        foreach ($properties as $property) {
            \App\Models\Property::create($property);
        }
    }
}
