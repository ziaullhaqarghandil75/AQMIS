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
        $this->Call(PermissionCategorySeeder::class);
        $this->Call(PermissionSeeder::class);
        $this->Call(RoleSeeder::class);
        $this->Call(PermissionRoleSeeder::class);
        $this->Call(UserSeeder::class);
        $this->Call(RoleUserSeeder::class);
        $this->Call(DistrictSeeder::class);
    }
}
