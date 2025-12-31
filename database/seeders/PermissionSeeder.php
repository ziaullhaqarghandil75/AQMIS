<?php

namespace Database\Seeders;

use App\Models\UserSettings\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            ['name' => 'view_user', 'description' => 'کاربران', 'permission_category_id' => 1],
            ['name' => 'view_permissions', 'description' => 'سطوح دسترسی', 'permission_category_id' => 1],
            ['name' => 'view_role', 'description' => 'سطح دسترسی', 'permission_category_id' => 1],
            ['name' => 'user_settings', 'description' => 'تنظیمات کاربران', 'permission_category_id' => 1],
            ['name' => 'add_user', 'description' => 'افزودن', 'permission_category_id' => 4],
            ['name' => 'edit_user', 'description' => 'تصحیح', 'permission_category_id' => 4],
            ['name' => 'delete_user', 'description' => 'حذف', 'permission_category_id' => 4],
            ['name' => 'add_permission_category', 'description' => 'افزودن دسته بندی سطح دسترسی', 'permission_category_id' => 3],
            ['name' => 'add_permission', 'description' => 'نمایش', 'permission_category_id' => 3],
            ['name' => 'add_role', 'description' => 'افزودن', 'permission_category_id' => 2],
            ['name' => 'edit_role', 'description' => 'تصحیح', 'permission_category_id' => 2],
            ['name' => 'delete_role', 'description' => 'حذف', 'permission_category_id' => 2],
            ['name' => 'add_permission_to_role', 'description' => 'افزودن سطوح دسترسی', 'permission_category_id' => 2],
            ['name' => 'edit_profile', 'description' => 'تصحیح پروفایل', 'permission_category_id' => 4],
            ['name' => 'reset_password_user', 'description' => 'ریست کردن پسورد', 'permission_category_id' => 4],
            ['name' => 'active_inactive', 'description' => 'فعال یا غیرفعال کاربر', 'permission_category_id' => 4],
            ['name' => 'logout_specific_user', 'description' => 'خروج کاربر مشخص از سیسیتم', 'permission_category_id' => 4],
            ['name' => 'user_profile', 'description' => 'پروفایل کاربر', 'permission_category_id' => 4],
            ['name' => 'change_password_user', 'description' => 'تغیر رمزعبور', 'permission_category_id' => 4],
            ['name' => 'show_pro_info', 'description' => 'نمایش پروفایل کاربر', 'permission_category_id' => 4],
            ['name' => 'view_guzar', 'description' => 'گذر', 'permission_category_id' => 5],
            ['name' => 'add_guzar', 'description' => 'افزودن', 'permission_category_id' => 6],
            ['name' => 'delete_guzar', 'description' => 'حذف', 'permission_category_id' => 6],
            ['name' => 'view_block', 'description' => 'بلاک', 'permission_category_id' => 7],
            ['name' => 'add_block', 'description' => 'افزودن', 'permission_category_id' => 7],
            ['name' => 'delete_block', 'description' => 'حذف', 'permission_category_id' => 7],
            ['name' => 'systems_settings', 'description' => 'سیستم', 'permission_category_id' => 5],
            ['name' => 'view_zone', 'description' => 'زون', 'permission_category_id' => 5],
            ['name' => 'add_zone', 'description' => 'افزودن', 'permission_category_id' => 8],
            ['name' => 'edit_zone', 'description' => 'تصحیح', 'permission_category_id' => 8],
            ['name' => 'delete_zone', 'description' => 'حذف', 'permission_category_id' => 8],
            ['name' => 'view_land_category', 'description' => 'کتگوری زمین', 'permission_category_id' => 5],
            ['name' => 'add_land_category', 'description' => 'افزودن', 'permission_category_id' => 9],
            ['name' => 'edit_land_category', 'description' => 'تصحیح', 'permission_category_id' => 9],
            ['name' => 'delete_land_category', 'description' => 'حذف', 'permission_category_id' => 9],

        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
    }
}
