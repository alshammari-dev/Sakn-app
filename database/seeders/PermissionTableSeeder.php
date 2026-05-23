<?php
  
namespace Database\Seeders;
  
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
  
class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
           // Role Management
           'role-list',
           'role-create',
           'role-edit',
           'role-delete',

           // User Management
           'user-list',
           'user-create',
           'user-edit',
           'user-delete',

           // Permission Management
           'permission-list',
           'permission-create',
           'permission-edit',
           'permission-delete',

           // Property Management
           'property-list',
           'property-create',
           'property-edit',
           'property-delete',
           'list-propertie',    // Existing misspelled usage in dashboard
           'delete-propertie',  // Existing misspelled usage in property index

           // Property Image Management
           'property-image-list',
           'property-image-create',
           'property-image-edit',
           'property-image-delete',

           // Property Document Management
           'property-document-list',
           'property-document-create',
           'property-document-edit',
           'property-document-delete',

           // Visit Management
           'visit-list',
           'visit-create',
           'visit-edit',
           'visit-delete',
           'visit-quick-update',

           // Offer Management
           'offer-list',
           'offer-create',
           'offer-edit',
           'offer-delete',
           'offer-quick-update',

           // Deposit Management
           'deposit-list',
           'deposit-create',
           'deposit-edit',
           'deposit-delete',
           'deposit-approve',
           'deposit-reject',

           // Sale Approval Management
           'sale-approval-list',
           'sale-approval-create',
           'sale-approval-edit',
           'sale-approval-delete'
        ];
        
        foreach ($permissions as $permission) {
             Permission::findOrCreate($permission, 'web');
        }
    }
}