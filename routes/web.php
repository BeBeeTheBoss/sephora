<?php

use App\Http\Controllers\HomePageController;
use App\Http\Controllers\AdminController;
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

Route::controller(HomePageController::class)->group(function () {
    Route::get('/', 'homePage')->name('home');
});

Route::prefix('admin')->controller(AdminController::class)->group(function(){
    Route::get('/dashboard', 'index')->name('index');
});