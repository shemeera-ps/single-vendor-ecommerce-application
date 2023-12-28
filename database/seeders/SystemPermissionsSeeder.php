<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Ynotz\AccessControl\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SystemPermissionsSeeder extends Seeder
{
    private $permissions = [
        'System Settings: Create',
        'System Settings: View',
        'System Settings: Edit',
        'System Settings: Delete',
        'App Settings: Create',
        'App Settings: View',
        'App Settings: Edit',
        'App Settings: Delete',
    ];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->permissions as $p) {
            Permission::create([
                'name' => $p
            ]);
        }
    }
}
