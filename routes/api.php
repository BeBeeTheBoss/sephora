<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\WishListController;
use App\Http\Controllers\HubSpotWebhookController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['prefix' => 'categories', 'controller' => CategoryController::class], function () {
    Route::get('/', 'index');
    Route::middleware('auth:sanctum', 'is_admin')->group(function () {
        Route::post('/', 'store');
        Route::put('/', 'update');
        Route::delete('/', 'destroy');
    });
});

Route::group(['prefix' => 'products', 'controller' => ProductController::class], function () {
    Route::get('/', 'index');
    Route::middleware('auth:sanctum', 'is_admin')->group(function () {
        Route::post('/', 'store');
        Route::put('/', 'update');
        Route::delete('/', 'destroy');
    });
});


//Noti
Route::post('/noti-off', [WishListController::class, 'notiOff']);
