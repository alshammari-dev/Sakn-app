<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class AssignAdminRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $role = Role::findOrCreate('admin');

        
        $permissions = Permission::all();
        $role->syncPermissions($permissions); 

        
        $user = User::first(); 
        if ($user) {
            $user->assignRole($role);
           
            $this->command->info("تم تعيين المستخدم '{$user->name}' كـ Admin بنجاح.");
        } else {
            $this->command->error("لا يوجد مستخدمين في قاعدة البيانات! سجل حساب أولاً.");
        }
    }
}