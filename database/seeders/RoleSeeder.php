<?php

namespace Database\Seeders;

use App\Models\UserSettings\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'name' => 'admin',
            'description' => 'ادمین',
            'status' => '1',
        ]);
    }
}
