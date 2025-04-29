<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BoardingHouseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\LoginHistoryController;
use App\Http\Controllers\ManageUsersController;

/*
|----------------------------------------------------------------------|
| Web Routes                                                          |
|----------------------------------------------------------------------|
*/

// Public Route
Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes
Route::controller(LoginRegisterController::class)->group(function () {
    Route::get('/register', 'register')->name('register')->middleware('guest');
    Route::post('/store', 'store')->name('store');
    Route::get('/login', 'login')->name('login')->middleware('guest');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::post('/logout', 'logout')->name('logout')->middleware('auth');
});

// Route for Dashboard with Role-Based Redirection
Route::middleware(['auth'])->get('/dashboard', [LoginRegisterController::class, 'dashboard'])->name('dashboard');

// Admin Routes
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/boardinghouse', [AdminController::class, 'showBoardingHouse'])->name('admin.boardinghouse');

    // Tenant Registration Route (Admin Only)
    Route::post('/tenant/request', [TenantController::class, 'store'])->name('tenant.request');

    // Login History Route (Admin Only)
    Route::get('/login-history', [LoginHistoryController::class, 'index'])->name('login.history');

    // Manage Users Routes
    Route::get('/manage-users', [ManageUsersController::class, 'index'])->name('manage.users');  // View Users
    Route::get('/manage-users/{user}/edit', [ManageUsersController::class, 'edit'])->name('manage.users.edit'); // Edit User Form
    Route::put('/manage-users/{user}', [ManageUsersController::class, 'update'])->name('manage.users.update'); // Update User
    Route::delete('/manage-users/{user}', [ManageUsersController::class, 'destroy'])->name('manage.users.destroy'); // Delete User
});

// User Routes
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/dashboard', [UserController::class, 'index'])->name('user.dashboard');
});

// Boarding House Owner Routes
Route::prefix('boardinghouse')->middleware(['auth', 'role:boardinghouse'])->group(function () {
    Route::get('/dashboard', [BoardingHouseController::class, 'index'])->name('boarding.dashboard');
    Route::post('/add-tenant', [TenantController::class, 'store'])->name('boardinghouse.addTenant');
});

// Profile Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});
