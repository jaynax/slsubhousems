<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BoardingHouseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LoginHistoryController;
use App\Http\Controllers\ManageUsersController;
use App\Http\Controllers\TenantController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
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

// Dashboard with Role-Based Redirection
Route::middleware('auth')->get('/dashboard', [LoginRegisterController::class, 'dashboard'])->name('dashboard');

// Admin Routes - use AdminController::dashboard to provide data to view
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {

    // Dashboard with data
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Boarding House management
    Route::get('/boardinghouse', [BoardingHouseController::class, 'showBoardingHouse'])->name('admin.boardinghouse');

    // Login history
    Route::get('/login-history', [LoginHistoryController::class, 'index'])->name('login.history');

    // Manage Users routes
    Route::prefix('manage-users')->group(function () {
        Route::get('/', [ManageUsersController::class, 'index'])->name('manage.users');
        Route::get('/create', [ManageUsersController::class, 'create'])->name('manage.users.create');
        Route::post('/', [ManageUsersController::class, 'store'])->name('manage.users.store');
        Route::get('/{user}', [ManageUsersController::class, 'show'])->name('manage.users.show');
        Route::get('/{user}/edit', [ManageUsersController::class, 'edit'])->name('manage.users.edit');
        Route::put('/{user}', [ManageUsersController::class, 'update'])->name('manage.users.update');
        Route::delete('/{user}', [ManageUsersController::class, 'destroy'])->name('manage.users.destroy');

        // Boarding house creation for user
        Route::get('/{user}/boarding-house/create', [BoardingHouseController::class, 'createForUser'])->name('manage.users.boardinghouse.create');
        Route::post('/{user}/boarding-house', [BoardingHouseController::class, 'storeForUser'])->name('manage.users.boardinghouse.store');
    });

    // Admin user management routes (optional - can be same as above)
    Route::prefix('users')->group(function () {
        Route::get('/', [AdminController::class, 'manageUsers'])->name('admin.users.index');
        Route::get('/create', [AdminController::class, 'createUser'])->name('admin.users.create');
        Route::post('/', [AdminController::class, 'storeUser'])->name('admin.users.store');
    });
});

// User Routes
Route::prefix('user')->middleware(['auth', 'role:user'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'index'])->name('user.dashboard');

    // Tenant Application
    Route::post('/tenant/apply', [TenantController::class, 'apply'])->name('tenant.apply');
});

// Boarding House Owner Routes
Route::prefix('boardinghouse')->middleware(['auth', 'role:boardinghouse'])->group(function () {
    Route::get('/dashboard', [BoardingHouseController::class, 'index'])->name('boardinghouse.dashboard');
    Route::get('/create', [BoardingHouseController::class, 'create'])->name('boardinghouse.create');
    Route::post('/store', [BoardingHouseController::class, 'store'])->name('boardinghouse.store');

    Route::post('/tenant/{id}/approve', [TenantController::class, 'approve'])->name('tenant.approve');
    Route::post('/tenant/{id}/reject', [TenantController::class, 'reject'])->name('tenant.reject');
});

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});

// Tenant application routes with auth + role middleware for user
Route::post('/user/tenant/apply', [TenantController::class, 'apply'])->name('tenant.apply')->middleware(['auth', 'role:user']);
Route::post('/tenant/apply', [TenantController::class, 'apply'])->name('tenant.apply');
Route::post('/tenant/{id}/approve', [TenantController::class, 'approve'])->name('tenant.approve');
Route::post('/tenant/{id}/reject', [TenantController::class, 'reject'])->name('tenant.reject');
