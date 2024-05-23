<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CanteenController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/users', [AuthController::class, 'index'])->name('users.index');
    Route::delete('/users/{id}', [AuthController::class, 'destroy'])->name('users.destroy');
});

Route::middleware(['auth', 'isOwner'])->group(function () {
    Route::get('/canteens/create', [CanteenController::class, 'create'])->name('canteens.create');
    Route::post('/canteens', [CanteenController::class, 'store'])->name('canteens.store');

    Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::delete('/transactions/{id}', [TransactionController::class, 'destroy'])->name('transactions.destroy');

    Route::get('/{unique_code}/pengaturan', [CanteenController::class, 'pengaturan'])->name('settings.canteen');
    Route::put('/{unique_code}/pengaturan', [CanteenController::class, 'pengaturan_update'])->name('settings.update');
});

Route::middleware(['auth', 'isPembeli'])->group(function () {
    Route::get('/canteens', [CanteenController::class, 'index'])->name('canteens.index');
    Route::get('/canteens/{unique_code}', [CanteenController::class, 'show'])->name('canteens.show');

    Route::post('/orders/store', [TransactionController::class, 'order'])->name('orders.store');

    Route::post('/transactions/store', [TransactionController::class, 'store'])->name('transactions.store');
});
