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

// Public Routes
Route::get('/', fn() => view('welcome'));

// Auth Routes
Route::controller(LoginRegisterController::class)->group(function () {
    Route::get('/register', 'register')->name('register')->middleware('guest');
    Route::post('/store', 'store')->name('store');
    Route::get('/login', 'login')->name('login')->middleware('guest');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::post('/logout', 'logout')->name('logout')->middleware('auth');
});

// Admin Routes
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::get('/boardinghouse', [BoardingHouseController::class, 'showBoardingHouse'])->name('admin.boardinghouse.index');

    Route::get('/login-history', [LoginHistoryController::class, 'index'])->name('login.history');

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

    Route::prefix('users')->group(function () {
        Route::get('/', [AdminController::class, 'manageUsers'])->name('admin.users.index');
        Route::get('/create', [AdminController::class, 'createUser'])->name('admin.users.create');
        Route::post('/', [AdminController::class, 'storeUser'])->name('admin.users.store');
    });
});

// User Routes
Route::prefix('user')->middleware(['auth', 'role:user'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'index'])->name('user.dashboard');
    Route::post('/tenant/apply', [TenantController::class, 'apply'])->name('tenant.apply');
});

// Boarding House Owner Routes
Route::prefix('boardinghouse')->middleware(['auth', 'role:boardinghouse'])->group(function () {
    Route::get('/dashboard', [BoardingHouseController::class, 'index'])->name('boardinghouse.dashboard');
    Route::get('/create', [BoardingHouseController::class, 'create'])->name('boardinghouse.create');
    Route::post('/store', [BoardingHouseController::class, 'store'])->name('boardinghouse.store');

    // Tenant routes (CRUD)
    Route::get('/tenants', [TenantController::class, 'index'])->name('boardinghouse.tenants.index');
    Route::get('/tenant/create', [TenantController::class, 'create'])->name('tenant.create');  // create form
    Route::post('/tenant', [TenantController::class, 'store'])->name('tenant.store');          // save new tenant

    Route::get('/tenant/{tenant}', [TenantController::class, 'show'])->name('tenant.show');    // read
    Route::get('/tenant/{tenant}/edit', [TenantController::class, 'edit'])->name('tenant.edit'); // edit form
    Route::put('/tenant/{tenant}', [TenantController::class, 'update'])->name('tenant.update');  // update tenant

    Route::delete('/tenant/{tenant}', [TenantController::class, 'destroy'])->name('tenant.destroy'); // delete tenant

    // Tenant approval & rejection
    Route::post('/tenant/{id}/approve', [TenantController::class, 'approve'])->name('tenant.approve');
    Route::post('/tenant/{id}/reject', [TenantController::class, 'reject'])->name('tenant.reject');

    // Boarding House Owner edit boarding house info routes (added)
    Route::get('/edit', [BoardingHouseController::class, 'edit'])->name('boardinghouse.edit');
    Route::post('/update', [BoardingHouseController::class, 'update'])->name('boardinghouse.update');
});

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});
