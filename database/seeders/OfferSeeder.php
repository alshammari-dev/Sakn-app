<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Offer;
use App\Models\Property;
use App\Models\User;

class OfferSeeder extends Seeder
{
    public function run()
    {
        $properties = Property::all();
        $agentIds = User::role('sale-agent')->pluck('id')->toArray();
        $clientIds = User::role('client')->pluck('id')->toArray();

        foreach (range(1, 10) as $index) {
            $property = $properties->random();
            
            
            $variation = $property->price * 0.1;
            $offeredPrice = $property->price + rand(-$variation, $variation);

            Offer::create([
                'property_id'   => $property->id,
                'client_id'     => $clientIds[array_rand($clientIds)],
                'agent_id'      => $agentIds[array_rand($agentIds)],
                'offered_price' => $offeredPrice,
                'status'        => ['pending', 'accepted', 'rejected', 'cancelled'][rand(0, 3)],
                'notes'         => 'the offer ' . $index,
            ]);
        }
    }
}