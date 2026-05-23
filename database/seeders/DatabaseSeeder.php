<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PermissionTableSeeder::class,
            RolesAndUsersSeeder::class,
            UserSeeder::class,
            PropertySeeder::class,
            PropertyImageSeeder::class,
            PropertyDocumentSeeder::class,
            OfferSeeder::class,
            VisitSeeder::class,
            DepositSeeder::class,
            SaleApprovalSeeder::class,
            FavoriteSeeder::class,
        ]);
    }
}
