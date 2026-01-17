<?php

use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\BlockController;
use App\Http\Controllers\BuildingCategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuzarController;
use App\Http\Controllers\LandCategoryController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\UserSettings\PermissionController;
use App\Http\Controllers\UserSettings\RoleController;
use App\Http\Controllers\UserSettings\UserController;
use App\Http\Controllers\ZoneController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\PropertyController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DependentDropdownController;
use App\Http\Controllers\PropertyValueController;

Route::middleware(['auth', 'checkFirstLogin', 'checkPasswordExpired'])->group(function () {
    //project routes
    Route::resource('projects', ProjectController::class);
    //owners routes
    Route::resource('owners', OwnerController::class);
    // building Category routes
    Route::resource('buildingCategory', BuildingCategoryController::class);
    // property routes
    Route::resource('properties', PropertyController::class);
    Route::resource('propertiesValue', PropertyValueController::class);
    // Dependent Dropdown Routes
    Route::prefix('dependent')->name('dependent.')->group(function () {
        Route::get('/district/{id}/guzars', [DependentDropdownController::class, 'getGuzarsByDistrict'])->name('district.guzars');
        Route::get('/guzar/{id}/blocks', [DependentDropdownController::class, 'getBlocksByGuzar'])->name('guzar.blocks');
        Route::get('/district/{id}/zones', [DependentDropdownController::class, 'getZonesByDistrict'])->name('district.zones');
        Route::get('/zone/{id}/categories', [DependentDropdownController::class, 'getCategoriesByZone'])->name('zone.categories');
        Route::get('/project/{id}/owner', [DependentDropdownController::class, 'getOwnerByProject'])->name('project.owners');
    });

    // User Settings Routes
    Route::get('changePasswordExpired', [PasswordController::class, 'passwordExpired'])->name('passwordChangeExpired');
    Route::put('changePasswordExpired', [PasswordController::class, 'storeExpiredPassword'])->name('passwordExpiredStore');

    Route::get('/', [DashboardController::class, 'index']);
    Route::match(['get', 'post'], '/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile/{user_id?}', [UserController::class, 'profile'])->name('user.profile');
    Route::put('/update_profile', [UserController::class, 'update_profile'])->name('user.update_profile');
    Route::post('/reset/password/{user_id}', [PasswordController::class, 'reset_password'])->name('reset_password');
    Route::get('change_password', [PasswordController::class, 'index'])->name('password-change');
    Route::put('change_password', [PasswordController::class, 'store'])->name('new.password.store');
    Route::put('profile_change_password', [PasswordController::class, 'profile_change_password'])->name('profile_change_password');

    Route::post('/add_permission_category', [PermissionController::class, 'add_permission_category'])->name('add_permission_category');
    Route::resource('permissions', PermissionController::class);
    Route::resource('roles', RoleController::class);
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::get('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/user_status/{user_id}', [UserController::class, 'user_status'])->name('user.status');
    Route::get('/logout_specific_user/{id}', [UserController::class, 'logout_specific_user'])->name('logout_specific_user');


    // Guzar Routes
    Route::get('guzar_list', [GuzarController::class, 'index'])->name('guzar.index');
    Route::post('add_guzar', [GuzarController::class, 'store'])->name('guzar.store');
    Route::delete('delete_guzar/{id}', [GuzarController::class, 'destroy'])->name('guzar.delete');

    // block routes
    Route::get('/get-guzars/{district_id}', [BlockController::class, 'get_guzars'])->name('get.guzars');
    Route::get('/block_list', [BlockController::class, 'index'])->name('block.index');
    Route::post('/add_block', [BlockController::class, 'store'])->name('block.store');
    Route::delete('/delete_block/{id}', [BlockController::class, 'destroy'])->name('block.delete');

    // zone routes
    Route::get('/zone_list', [ZoneController::class, 'index'])->name('zone.index');
    Route::post('/add_zone', [ZoneController::class, 'store'])->name('zone.store');
    Route::delete('/delete_zone/{id}', [ZoneController::class, 'destroy'])->name('zone.delete');
    Route::put('/edit_zone/{id}', [ZoneController::class, 'update'])->name('zone.update');
    Route::get('/get-zones/{district_id}', [ZoneController::class, 'getZones']);


    // land category routes
    // Route::match(['get', 'post'], 'land-category/list', [LandCategoryController::class, 'index'])
    //     ->name('land_category.index');

    Route::match(['get', 'post'], '/land_category_list', [LandCategoryController::class, 'index'])->name('land_category.index');
    Route::post('/add_land_category', [LandCategoryController::class, 'store'])->name('land_category.store');
    Route::delete('/delete_land_category/{id}', [LandCategoryController::class, 'destroy'])->name('land_category.delete');
    Route::put('/edit_land_category/{id}', [LandCategoryController::class, 'update'])->name('land_category.update');
    Route::get('/get-land-category/{id}', [LandCategoryController::class, 'getLandCategory']);
});
require __DIR__ . '/auth.php';
