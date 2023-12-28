<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /**
         * @var User
         */
        $u = User::factory()->create(
            [
                'name' => 'System Admin',
                'email' => 'systemadmin@demo.com',
                'password' => Hash::make('abcd1234')
            ]
        );
        $u->assignRole('System Admin');
        $u = User::factory()->create(
            [
                'name' => 'Admin',
                'email' => 'admin@demo.com',
                'password' => Hash::make('abcd1234')
            ]
        );
        $u->assignRole('Admin');

    }
}
