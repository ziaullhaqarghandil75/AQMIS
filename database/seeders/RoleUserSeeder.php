<?php

namespace Database\Seeders;

use App\Models\UserSettings\RoleUser;
use Illuminate\Database\Seeder;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RoleUser::create([
            'user_id' => 1,
            'role_id' => 1,
        ]);
    }
}
