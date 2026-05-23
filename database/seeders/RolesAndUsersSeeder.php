<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class RolesAndUsersSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $roles = [
            'admin',
            'content manager',
            'sale-agent',
            'client'
        ];

        foreach ($roles as $roleName) {
            Role::firstOrCreate(['name' => $roleName]);
        }

        // Give all permissions to admin
        $adminRole = Role::findByName('admin');
        $adminRole->syncPermissions(\Spatie\Permission\Models\Permission::all());

        $password = Hash::make('12341234');

        $admin = User::firstOrCreate(
            ['email' => 'admin@test.com'],
            ['name' => 'Admin User', 'password' => $password]
        );
        $admin->assignRole('admin');

        $contentManager = User::firstOrCreate(
            ['email' => 'content@test.com'],
            ['name' => 'Content Manager', 'password' => $password]
        );
        $contentManager->assignRole('content manager');

        $salesAgent = User::firstOrCreate(
            ['email' => 'sales@test.com'],
            ['name' => 'Sales Agent', 'password' => $password]
        );
        $salesAgent->assignRole('sale-agent');

        $client = User::firstOrCreate(
            ['email' => 'client@test.com'],
            ['name' => 'Client User', 'password' => $password]
        );
        $client->assignRole('client');
    }
}