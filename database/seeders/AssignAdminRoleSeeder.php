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
        // 1. إنشاء الرتبة (تأكد من حالة الأحرف admin أو Admin حسب مشروعك)
        $role = Role::findOrCreate('admin');

        // 2. جلب كل الصلاحيات الموجودة في قاعدة البيانات وربطها بالرتبة
        $permissions = Permission::all();
        $role->syncPermissions($permissions); 

        // 3. البحث عن أول مستخدم وتعيينه كـ Admin
        $user = User::first(); 
        if ($user) {
            $user->assignRole($role);
            // رسالة تأكيد تظهر بالترمينال
            $this->command->info("تم تعيين المستخدم '{$user->name}' كـ Admin بنجاح.");
        } else {
            $this->command->error("لا يوجد مستخدمين في قاعدة البيانات! سجل حساب أولاً.");
        }
    }
}