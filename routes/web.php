<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/', [\App\Http\Controllers\DashboardController::class, 'show'])->name('dashboard.show');
    Route::get('/customers', [\App\Http\Controllers\CustomerController::class, 'index'])->name('customers.index');
    Route::get('/customers/{id}', [\App\Http\Controllers\CustomerController::class, 'show'])->name('customers.show');
    Route::get('/orders', [\App\Http\Controllers\OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [\App\Http\Controllers\OrderController::class, 'show'])->name('orders.show');
    Route::get('/products', [\App\Http\Controllers\ProductController::class, 'index'])->name('products.index');
    Route::get('/products/{id}', [\App\Http\Controllers\ProductController::class, 'show'])->name('products.show');

    //Reports
    Route::get('/reports/best-sellers', [\App\Http\Controllers\ReportController::class, 'bestSellers'])->name('reports.best-sellers');
    Route::get('/reports/best-customers', [\App\Http\Controllers\ReportController::class, 'bestCustomers'])->name('reports.best-customers');
    Route::get('/reports/order-status', [\App\Http\Controllers\ReportController::class, 'orderStatus'])->name('reports.order-status');

});
