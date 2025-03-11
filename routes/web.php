<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BoardingHouseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\PaymentController;

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

// Redirect Based on Role
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        $user = auth()->user();
        if ($user->role_id == 1) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role_id == 2) {
            return redirect()->route('user.dashboard');
        } elseif ($user->role_id == 3) {
            return redirect()->route('boarding.dashboard');
        } else {
            abort(403);
        }
    })->name('dashboard');
});

// Admin Routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');


    Route::get('/admin/boardinghouse', [AdminController::class, 'showBoardingHouse'])->name('admin.boardinghouse');


    Route::post('/admin/payment/update/{tenant_id}', [PaymentController::class, 'updatePayment'])->name('admin.payment.update');
});

// User Routes
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/dashboard', [UserController::class, 'index'])->name('user.dashboard');
});

// Boarding House Owner Routes
Route::middleware(['auth', 'role:boardinghouse'])->group(function () {
    Route::get('/boarding/dashboard', [BoardingHouseController::class, 'index'])->name('boarding.dashboard');
    Route::post('/boardinghouse/add-tenant', [TenantController::class, 'store'])->name('boardinghouse.addTenant');
});

// Tenant Registration Route
Route::middleware(['auth'])->group(function () {
    Route::post('/tenant/request', [TenantController::class, 'store'])->name('tenant.request');
});

// Profile Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});
