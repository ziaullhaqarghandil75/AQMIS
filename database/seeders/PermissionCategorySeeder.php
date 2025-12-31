<?php

namespace Database\Seeders;

use App\Models\UserSettings\PermissionCategory;
use Illuminate\Database\Seeder;

class PermissionCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'تنظیمات حساب کاربری',
            'سطح دسترسی',
            'سطوح دسترسی',
            'کاربران',
            'سیستم',
            'گذر',
            'بلاک', 
            'زون', 
            'کتگوری زمین', 

        ];

        foreach ($categories as $category_name) {
            PermissionCategory::create(['name' => $category_name]);
        }
    }
}
