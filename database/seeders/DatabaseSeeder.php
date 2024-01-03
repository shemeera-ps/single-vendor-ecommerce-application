<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(SystemPermissionsSeeder::class);
        //$this->call(SystemRolesSeeder::class);
        $this->call(RolePermissionSeeder::class);
        $this->call(AppSettingSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(AddressTagSeeder::class);
        $this->call(SizeSeeder::class);
         $this->call(ProductSeeder::class);
      
        // $this->call(OrderSeeder::class);
        // $this->call(OrderItemSeeder::class);
        // $this->call(AddressSeeder::class);
         $this->call(TagSeeder::class);
        // $this->call(ProductTagSeeder::class);
        // $this->call(WishlistSeeder::class);
        // $this->call(AddressSeeder::class);
    }
}
