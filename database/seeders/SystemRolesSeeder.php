<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Ynotz\AccessControl\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SystemRolesSeeder extends Seeder
{
    private $roles = [
        'System Admin' => [
            'System Settings: Create',
            'System Settings: View',
            'System Settings: Edit',
            'System Settings: Delete',
            'App Settings: Create',
            'App Settings: Delete',
        ],
        'Admin' => [
            'App Settings: View',
            'App Settings: Edit',
        ]
    ];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->roles as $r => $ps) {
            /**
             * @var Role
             */
            $r = Role::create(
                ['name' => $r]
            );
            $r->assignPermissions(
                ...$ps
            );
        }
    }
}
