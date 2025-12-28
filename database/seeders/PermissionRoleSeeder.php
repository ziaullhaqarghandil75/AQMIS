<?php

namespace Database\Seeders;

use App\Models\UserSettings\PermissionRole;
use Illuminate\Database\Seeder;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = 1;

        for ($x = 1; $x <= 19; $x++) {
            PermissionRole::create([
                'role_id'       => $role,
                'permission_id' => $x,
            ]);
        }
    }
}
