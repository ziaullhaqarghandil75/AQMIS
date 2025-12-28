<?php

use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserSettings\PermissionController;
use App\Http\Controllers\UserSettings\RoleController;
use App\Http\Controllers\UserSettings\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'checkFirstLogin', 'checkPasswordExpired'])->group(function () {

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
});


require __DIR__ . '/auth.php';
