<?php

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\WishList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\WishListController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\FeedbackController;
use App\Http\Controllers\Admin\CarouselImageController;
use App\Http\Controllers\Admin\UserController;
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
    if (Auth::check()) {
        return response()->json(Auth::user());
    }

    return response()->json(null);
});

Route::get('/wishlists-count', function () {
    if (Auth::check()) {
        return response()->json(WishList::where('user_id', Auth::user()->id)->count());
    }
    return 0;
});

Route::get('/cart-count', function () {
    if (Auth::check()) {
        return response()->json(Cart::where('user_id', Auth::user()->id)->count());
    }

    return 0;
});

Route::get('/orders-count', function () {
    if (Auth::check()) {
        return response()->json(Order::where('user_id', Auth::user()->id)->where('status', 'PENDING')->count());
    }
    return 0;
});

Route::get('/search', function (Request $request) {
    $products = Product::where('is_active', 1)->with('category')
        ->when($request->category_id, function ($query) use ($request) {
            $query->where('category_id', $request->category_id);
        })
        ->when($request->name, function ($query) use ($request) {
            $query->where('name', 'like', '%' . $request->name . '%')
                ->orWhere('price', 'like', '%' . $request->name . '%')
                ->orWhereHas('category', function ($query) use ($request) {
                    $query->where('categories.name', 'like', '%' . $request->name . '%');
                });
        })

        ->when(Auth::user(), function ($query) {
            $query->withCount(['wish_lists as is_favorite' => function ($query) {
                $query->where('user_id', Auth::user()->id);
            }]);
        })
        ->with('images')->get();

    foreach ($products as $product) {
        foreach ($product->images as $image) {
            $image->image = asset('storage/images/' . $image->image);
        }
    }

    return $products;
});

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'loginPage')->name('loginPage');
    Route::get('/sign-up', 'signUpPage')->name('signUpPage');
    Route::post('/login', 'login')->name('login');
    Route::post('/sign-up', 'signUp')->name('signUp');
    Route::post('/logout', 'logout')->name('logout');
});

Route::post('/destroy-session', function () {
    // Session::flush();
    return response()->json(['status' => 'Session destroyed']);
});


//home
Route::controller(HomePageController::class)->group(function () {
    Route::get('/', 'homePage')->name('home');
});

//cart
Route::group(['prefix' => '/cart', 'controller' => CartController::class, 'as' => 'cart.'], function () {
    Route::get('/', 'index')->name('cart');
    Route::post('/', 'store')->name('create');
    Route::delete('/', 'destroy')->name('delete');
});

//wishlist
Route::group(['prefix' => '/wish-lists', 'controller' => WishListController::class, 'as' => 'wish_lists.'], function () {
    Route::get('/', 'index')->name('wishListPage');
    Route::post('/', 'store')->name('create');
});

//products
Route::group(['prefix' => '/product', 'controller' => UserProductController::class, 'as' => 'products.'], function () {
    Route::get('/details/{id}', 'show')->name('productDetails');
    Route::post('/{id}/increment-view', 'viewCount')->name('view-count');
    Route::get('/trending', 'trending')->name('trending');
    Route::get('/popular', 'popular')->name('popular');
    Route::get('/recommend', 'recommend')->name('recommend');
    Route::get('/new_arrival', 'new_arrival')->name('new-arrival');
});

//orders
Route::group(['prefix' => '/orders', 'controller' => UserOrderController::class, 'as' => 'orders.'], function () {
    Route::get('/', 'index')->name('orderPage');
    Route::get('/all', 'phoneSizePage')->name('phoneSize');
    Route::post('/', 'store')->name('create');
    Route::post('/refund', 'refund')->name('refund');
    Route::post('/received', 'received')->name('received');
});

Route::middleware('auth')->group(function () {
    Route::group(['prefix' => '/admin', 'middleware' => ['auth.is_admin', 'auth']], function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
        //Categories
        Route::group(['prefix' => 'categories', 'controller' => CategoryController::class, 'as' => 'categories.'], function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::post('/{id}/update', 'update')->name('update');
            Route::delete('/{id}/delete', 'destroy')->name('destroy');
        });

        //Products
        Route::group(['prefix' => 'products', 'controller' => ProductController::class, 'as' => 'products.'], function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::post('/{id}/update', 'update')->name('update');
            Route::post('/toggleSwitch', 'toggleSwitch')->name('toggle');
            Route::delete('/{id}/delete', 'destroy')->name('destroy');
            Route::get('/{id}/detail', 'detail')->name('detail');
        });

        //Orders
        Route::group(['prefix' => 'orders', 'controller' => OrderController::class, 'as' => 'orders.'], function () {
            Route::get('/', 'index')->name('index');
            Route::post('/decision/', 'decision')->name('decision');
        });

        //Payments
        Route::group(['prefix' => 'payments', 'controller' => PaymentController::class, 'as' => 'payments.'], function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::post('/{id}/update', 'update')->name('update');
            Route::post('/toggleSwitch', 'toggleSwitch')->name('toggle');
            Route::delete('/{id}/delete', 'destroy')->name('destroy');
        });

        //Carousel Images
        Route::group(['prefix' => 'carousel_images', 'controller' => CarouselImageController::class, 'as' => 'carousel_images.'], function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::post('/{id}/update', 'update')->name('update');
            Route::delete('/{id}/delete', 'destroy')->name('destroy');
        });

        //Feedbacks
        // Route::controller(FeedBackController::class)->group(function () {
        //     Route::get('/feedback', 'feedback')->name('feedback');
        // });

        //Profile
        Route::controller(ProfileController::class)->group(function () {
            Route::get('/profile', 'profile')->name('profile');
            Route::post('/updateProfile', 'update')->name('updateProfile');
        });

        //Users
        Route::group(['prefix' => 'users', 'controller' => UserController::class, 'as' => 'users.'], function () {
            Route::get('/', 'index')->name('index');
            Route::delete('/{id}/delete', 'destroy')->name('destroy');
        });
    });
});
