<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;

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

Route::controller(HomePageController::class)->group(function () {
    Route::get('/', 'homePage')->name('home');
});

Route::prefix('/admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('index');

    //Categories
    Route::group(['prefix' => 'categories', 'controller' => CategoryController::class, 'as' => 'categories.'], function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::post('/{id}/update', 'update')->name('update');
        Route::post('/{id}', 'destroy')->name('destroy');
    });

    //Products
    Route::group(['prefix' => 'products', 'controller' => ProductController::class, 'as' => 'products.'], function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
    });

    //Orders
    Route::group(['prefix' => 'orders', 'controller' => OrderController::class, 'as' => 'orders.'], function () {
        Route::get('/', 'index')->name('index');
    });

    //Payments
    Route::group(['prefix' => 'payments', 'controller' => PaymentController::class, 'as' => 'payments.'], function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::post('/{id}/update', 'update')->name('update');
    });
});
