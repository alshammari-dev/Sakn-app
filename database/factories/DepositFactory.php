<?php

namespace Database\Factories;

use App\Models\Deposit;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Deposit>
 */
class DepositFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'property_id' => \App\Models\Property::inRandomOrder()->first()->id ?? 1,
            'client_id' => User::whereHas('roles', fn($q) => $q->where('name', 'client'))->inRandomOrder()->first()->id ?? 1,
            'approved_by' => User::whereHas('roles', fn($q) => $q->where('name', 'sale-agent'))->inRandomOrder()->first()->id ?? 1,
            'amount' => $this->faker->randomFloat(2, 1000, 100000),
            'status' => $this->faker->randomElement([
                \App\Models\Deposit::STATUS_PENDING,
                \App\Models\Deposit::STATUS_APPROVED,
                \App\Models\Deposit::STATUS_REJECTED,
                \App\Models\Deposit::STATUS_REFUNDED,
            ]),
            'receipt_url' => $this->faker->url(),
            'paid_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
