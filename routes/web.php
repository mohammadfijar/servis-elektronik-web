<?php

// routes/web.php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\PenjualanController;

// Public routes
Route::get('/', [LandingPageController::class, 'index'])->name('landing');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.show');
Route::post('/login', [AuthController::class, 'login'])
     ->middleware('throttle:5,1')
     ->name('login.store');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.show');
Route::post('/register', [AuthController::class, 'register'])->name('register.store');
Route::get('/dashboard',            [DashboardController::class, 'index'])->name('dashboard');

// Protected routes
Route::middleware('auth')->group(function () {
    // Dashboard per role
    Route::get('/dashboard/owner',      [DashboardController::class, 'owner'])->name('dashboard.owner');
    Route::get('/dashboard/admin',      [DashboardController::class, 'admin'])->name('dashboard.admin');
    Route::get('/dashboard/staff',      [DashboardController::class, 'staff'])->name('dashboard.staff');

    // Export XLSX
    Route::get('/export-services-xlsx',    [ServiceController::class,     'exportXlsx'])->name('services.export');
    Route::get('/export-suppliers-xlsx',   [SupplierController::class,    'exportXlsx'])->name('suppliers.export');
    Route::get('/export-transactions-xlsx',[TransactionController::class, 'exportXlsx'])->name('transactions.export');

    // Resourceful controllers
    Route::resource('categories',   CategoryController::class);
    Route::resource('items',        ItemController::class);
    Route::resource('customers',    CustomerController::class);
    Route::resource('services',     ServiceController::class);
    Route::resource('suppliers',    SupplierController::class);
    Route::resource('transactions', TransactionController::class);
    Route::resource('users', UserController::class);

    // Profile & logout
    Route::get ('/profile', [AuthController::class, 'showProfile'])->name('profile.show');
    Route::put ('/profile', [AuthController::class, 'updateProfile'])->name('profile.update');
    Route::post('/logout',  [AuthController::class, 'logout'])->name('logout');

    //Penjualan
    Route::resource('penjualan', PenjualanController::class);
});

