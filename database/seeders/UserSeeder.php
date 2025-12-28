<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'System',
            'last_name'=>'User',
            'phone'=>'1234567890',
            'email' => 'admin@email.com',
            'password' => bcrypt('Admin@123'),
            'status' => '1',
            'first_login' => 1,
            'password_change_status' => '1',
            'password_changed_at' => null,
        ]);
    }
}
