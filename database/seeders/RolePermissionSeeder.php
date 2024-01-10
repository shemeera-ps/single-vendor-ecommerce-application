<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Modules\Ynotz\AccessControl\Models\Role;
use Modules\Ynotz\AccessControl\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles= config('default.roles');
        foreach($roles as $role){
            Role::create([
                'name'=>$role
            ]);
        }
        $allPermissions= config('default.permissions');
        foreach ($allPermissions as $permission) {
            Permission::create([
                "name"=> $permission,
            ]);
        }
        $rolePermissions = [

            'System Admin'=>[
                
                "Administrative",
                "Products-Add",
                "Products-Update",
                "Products-View",
                "Products-Delete",
                "Categories-Add",
                "Categories-Update",
                "Categories-View",
                "Categories-Delete",
                "Cart-Add",
                "Cart-Update",
                "Cart-View",
                "Cart-Delete",
                "Orders-Add",
                "Orders-Update",
                "Orders-View",
                "Orders-Delete",

                "Tags-Add",
                "Product-Tags-Add",
                "Address-Add",
                "Address-Tag-Add",
                "Size-Add",
                "Product-Variant-Add",
                "Product-Type-Add",
                "Attribute-Add",
               

                'System Settings: Create',
                'System Settings: View',
                'System Settings: Edit',
                'System Settings: Delete',
                'App Settings: Create',
                'App Settings: Delete',
            ],
            'Admin'=>[
                "Administrative",
                "Products-Add",
                "Products-Update",
                "Products-View",
                "Products-Delete",
                "Categories-Add",
                "Categories-Update",
                "Categories-View",
                "Categories-Delete",
                "Cart-Add",
                "Cart-Update",
                "Cart-View",
                "Cart-Delete",
                "Orders-Add",
                "Orders-Update",
                "Orders-View",
                "Orders-Delete",
                "Tags-Add",
                "Product-Tags-Add",
                "Address-Add",
                "Address-Tag-Add",
                "Size-Add",
                "Product-Variant-Add",
                "Product-Attribute-Add",
                "Attribute-Add",
                'App Settings: View',
                'App Settings: Edit',
                

                "Product-Type-Add",
            ],
            'Vendor'=>[
                
                "Products-Add",
                "Products-Update",
                "Products-View",
                "Products-Delete",
                "Categories-Add",
                "Categories-Update",
                "Categories-View",
                "Categories-Delete",
                "Cart-Add",
                "Cart-Update",
                "Cart-View",
                "Cart-Delete",
                "Orders-Add",
                "Orders-Update",
                "Orders-View",
                "Orders-Delete",
                "Tags-Add",
                "Product-Tags-Add",
                "Address-Add",
                "Address-Tag-Add",
                "Size-Add",
                "Product-Variant-Add",
                
                "Attribute-Add",
                
                "Product-Type-Add",


            ],
            'Regular User'=>[
                
                
                "Products-View",
               
                "Categories-View",
                
                "Cart-Add",
                "Cart-Update",
                "Cart-View",
                "Cart-Delete",
                "Orders-Add",
              
                "Orders-View",
              
            ]
            ];
        
        foreach ($rolePermissions as $roleName => $permissions) {
                $role = Role::where('name', $roleName)->first();
                $role->permissions()->attach(Permission::whereIn('name', $permissions)->get());
            }
    }
}
