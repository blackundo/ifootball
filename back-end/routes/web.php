<?php

use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ShopController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductImageController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\OrderController;

use App\Http\Controllers\Front\CheckOutController;

//front client
Route::get('/', [HomeController::class, 'index']);

Route::prefix('shop')->group(function () {
    Route::get('/', [ShopController::class, 'index']);

    Route::get('product/{id}', [ShopController::class, 'show']);

    Route::post('product/{id}', [ShopController::class, 'postComment']);

    Route::get('{categoryName}', [ShopController::class, 'category']);
});


Route::prefix('cart')->group(function () {
    Route::get('/add/{id}', [CartController::class, 'add']);

    Route::get('/', [CartController::class, 'index']);
    Route::get('delete/{rowId}', [CartController::class, 'delete']);
    Route::get('update', [CartController::class, 'update']);
    Route::get('/destroy', [CartController::class, 'destroy']);
});

Route::prefix('checkout')->group(function () {
    Route::get('/', [CheckOutController::class, 'index']);
    Route::post('/', [CheckOutController::class, 'addOrder']);
    Route::get('/vnPaycheck', [CheckOutController::class, 'vnPayCheck']);
    Route::get('/result', [CheckOutController::class, 'result']);
});


Route::prefix('account')->group(function () {
    Route::get('login', [\App\Http\Controllers\Front\AccountController::class, 'login']);
    Route::post('login', [\App\Http\Controllers\Front\AccountController::class, 'checkLogin']);

    Route::get('logout', [\App\Http\Controllers\Front\AccountController::class, 'logout']);
    Route::get('register', [\App\Http\Controllers\Front\AccountController::class, 'register']);
    Route::post('register', [\App\Http\Controllers\Front\AccountController::class, 'postRegister']);

    Route::prefix('my-order')->middleware('CheckMemberLogin')->group(function () {
        Route::get('/', [\App\Http\Controllers\Front\AccountController::class, 'myOrderIndex']);
    });
});

//dashboard admin
// Route::prefix('admin')->group(function () {
//     Route::resource('user', \App\Http\Controllers\Admin\UserController::class);
// });
Route::prefix('admin')->group(function () {
    Route::redirect('', 'admin/user');
    Route::resource('user', UserController::class);
    Route::resource('author', AuthorController::class);
    Route::resource('category', \App\Http\Controllers\Admin\ProductCategoryController::class);
    Route::resource('product', ProductController::class);
    Route::resource('product/{product_id}/image', ProductImageController::class);
    Route::resource('order', OrderController::class);

    Route::prefix('login')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\HomeController::class, 'getLogin'])->withoutMiddleware('CheckAdminLogin');
        Route::post('/', [\App\Http\Controllers\Admin\HomeController::class, 'postLogin'])->withoutMiddleware('CheckAdminLogin');
    });

    Route::get('logout', [\App\Http\Controllers\Admin\HomeController::class, 'logout']);
});
