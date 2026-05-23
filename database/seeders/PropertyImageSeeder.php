<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PropertyImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $properties = \App\Models\Property::all();
        
        foreach ($properties as $property) {
            \App\Models\PropertyImage::create([
                'property_id' => $property->id,
                'url'         => 'https://placehold.co/800x600?text=Property+' . $property->id,
                'is_main'     => true,
                'sort_order'  => 0,
            ]);
            
            \App\Models\PropertyImage::create([
                'property_id' => $property->id,
                'url'         => 'https://placehold.co/800x600?text=Room+1+' . $property->id,
                'is_main'     => false,
                'sort_order'  => 1,
            ]);
        }
    }
}
