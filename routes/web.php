<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomePageController;

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

Route::prefix('admin')->controller(AdminController::class)->group(function(){
    Route::get('/dashboard', 'index')->name('index');
});

Route::controller(CategoryController::class)->group(function(){
    Route::get('/categories', 'index')->name('index');
});
