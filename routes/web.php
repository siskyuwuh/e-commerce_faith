<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/shop', [ShopController::class, 'index'])->name('shop');
Route::get('/shop/{name}/show', [ShopController::class, 'show'])->name('detail');


// Route::middleware('guest')->group(function () {

//     Route::get('/home', [HomeController::class, 'index'])->name('home');
// });

/*------------------------------------------
--------------------------------------------
All Normal Users Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:customer'])->group(function () {

    Route::post('/shop/{product_code}/order', [ShopController::class, 'order']);
    Route::get('/shop/{product_code}/checkout', [ShopController::class, 'checkout'])->name('checkout');
    Route::get('/{username}/order', [OrderController::class, 'index'])->name('order.customer');
    Route::get('/{username}/order/{id}/show', [OrderController::class, 'show'])->name('order.customer.detail');
    // Route::get('/home', [HomeController::class, 'index'])->name('home');
});

/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:admin'])->group(function () {

    Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin.home');
    Route::resource('/admin/product', ProductController::class);
    Route::get('order/admin', [ShopController::class, 'adminOrderList'])->name('order.list');
    Route::get('order/admin/{id}/check', [ShopController::class, 'adminConfirmationShow'])->name('order.check');
    Route::put('order/admin/{uuid_code}/update', [ShopController::class, 'adminConfirmation'])->name('order.update');
    // Route::get('/admin/product', [ProductController::class, 'index'])->name('admin.product.table');
    // Route::get('/admin/product/{id}/show', [ProductController::class, 'show'])->name('admin.product.show');
    // Route::get('/admin/product/create', [ProductController::class, 'create'])->name('admin.product.create');
    // Route::post('/admin/product/store', [ProductController::class, 'store'])->name('admin.product.store');
    // Route::get('/admin/product/{$id}/edit', [ProductController::class, 'edit'])->name('admin.product.edit');
    // Route::post('/admin/product/update', [ProductController::class, 'update'])->name('admin.product.update');
    // Route::get('/admin/product', [ProductController::class, 'create'])->name('admin.product.create');
});
// Route::get('/admin/home', [App\Http\Controllers\HomeController::class, 'index'])->name('admin.home');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
