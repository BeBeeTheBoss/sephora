<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\WishListController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CarouselImageController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\FeedbackController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\OrderController as UserOrderController;
use App\Http\Controllers\ProductController as UserProductController;

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

Route::get('/profile', function () {
    return response()->json(Auth::user());
});

Route::controller(AuthController::class)->group(function () {
    Route::get('/loginPage', 'loginPage')->name('loginPage');
});

Route::post('/destroy-session', function () {
    session()->invalidate(); // Destroys the session
    return response()->json(['status' => 'Session destroyed']);
});


//home
Route::controller(HomePageController::class)->group(function () {
    Route::get('/', 'homePage')->name('home');
});

//cart
Route::group(['prefix' => '/cart', 'controller' => CartController::class, 'as' => 'cart.'], function () {
    Route::get('/', 'index')->name('cart');
});

//wishlist
Route::group(['prefix' => '/wish-lists', 'controller' => WishListController::class, 'as' => 'wish_lists.'], function () {
    Route::get('/', 'index')->name('wishListPage');
    Route::post('/', 'store')->name('create');
});

//products
Route::group(['prefix' => '/product', 'controller' => UserProductController::class, 'as' => 'products.'], function () {
    Route::get('/details', 'show')->name('productDetails');
});

//orders
Route::group(['prefix' => '/orders', 'controller' => UserOrderController::class, 'as' => 'orders.'], function () {
    Route::get('/', 'index')->name('orderPage');
});

Route::prefix('/admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    //Categories
    Route::group(['prefix' => 'categories', 'controller' => CategoryController::class, 'as' => 'categories.'], function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::post('/{id}/update', 'update')->name('update');
        Route::post('/{id}/delete', 'destroy')->name('destroy');
    });

    //Products
    Route::group(['prefix' => 'products', 'controller' => ProductController::class, 'as' => 'products.'], function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::post('/{id}/update', 'update')->name('update');
        Route::post('/{id}/delete', 'destroy')->name('destroy');
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
        Route::post('/toggleSwitch', 'toggleSwitch')->name('toggle');
        Route::post('/{id}/delete', 'destroy')->name('destroy');
    });

    //Carousel Images
    Route::group(['prefix' => 'carousel_images', 'controller' => CarouselImageController::class, 'as' => 'carousel_images.'], function(){
        Route::get('/', 'index')->name('index');
    });

    //Feedbacks
    Route::controller(FeedBackController::class)->group(function () {
        Route::get('/feedback', 'feedback')->name('feedback');
    });

    //Profile
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'profile')->name('profile');
    });
});
