<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\LoginController as AdminLoginController;
use App\Http\Controllers\Admin\MailController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductPageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'dashboard'])->name('home');
Route::get('/product_details/{id}', [DashboardController::class, 'product_detail'])->name('product_detail');
Route::post('/add_cart/{id}', [DashboardController::class, 'add_cart'])->name('add_cart');
Route::get('/show_cart', [DashboardController::class, 'show_cart'])->name('show_cart');
Route::get('/remove_cart/{id}', [DashboardController::class, 'remove_cart'])->name('remove_cart');
Route::get('/cart_order', [DashboardController::class, 'cart_order'])->name('cart_order');
Route::get('/customer_order', [DashboardController::class, 'customer_order'])->name('customer_order');
Route::get('/cancel_order/{id}', [DashboardController::class, 'cancel_order'])->name('cancel_order');

Route::post('/add_comment', [DashboardController::class, 'add_comment'])->name('add_comment');
Route::post('/add_reply', [DashboardController::class, 'add_reply'])->name('add_reply');

Route::get('/product_search', [DashboardController::class, 'product_search'])->name('product_search');

Route::get('/product_page', [ProductPageController::class, 'product_page'])->name('product_page');
Route::get('/search_product', [ProductPageController::class, 'search_product'])->name('search_product');

Route::group(['prefix' => 'account'], function () {

    Route::group(['middleware' => 'guest'], function () {
        Route::get('/login', [LoginController::class, 'index'])->name('account.login');
        Route::post('/authenticate', [LoginController::class, 'authenticate'])->name('account.authenticate');
        Route::get('/register', [LoginController::class, 'register'])->name('account.register');
        Route::post('/processRegister', [LoginController::class, 'processRegister'])->name('account.processRegister');
    });

    Route::group(['middleware' => 'auth'], function () {
        Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('account.dashboard');
        Route::get('/logout', [LoginController::class, 'logout'])->name('account.logout');
    });
});

Route::group(['prefix' => 'admin'], function () {
    Route::group(['middleware' => 'admin.guest'], function () {
        Route::get('/login', [AdminLoginController::class, 'index'])->name('admin.login');
        Route::post('/authenticate', [AdminLoginController::class, 'authenticate'])->name('admin.authenticate');
    });

    Route::group(['middleware' => 'admin.auth'], function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

        //Category
        Route::get('/category', [CategoryController::class, 'index'])->name('admin.category');
        Route::get('/add_category', [CategoryController::class, 'add_category'])->name('admin.add_category');
        Route::post('/store_category', [CategoryController::class, 'store_category'])->name('admin.store_category');
        Route::get('/edit_category/{id}', [CategoryController::class, 'edit_category'])->name('admin.edit_category');
        Route::post('/update_category/{id}', [CategoryController::class, 'update_category'])->name('admin.update_category');
        Route::get('/delete_category/{id}', [CategoryController::class, 'delete_category'])->name('admin.delete_category');

        //Product
        Route::get('/product', [ProductController::class, 'index'])->name('admin.product');
        Route::get('/add_product', [ProductController::class, 'add_product'])->name('admin.add_product');
        Route::post('/store_product', [ProductController::class, 'store_product'])->name('admin.store_product');
        Route::get('/edit_product/{id}', [ProductController::class, 'edit_product'])->name('admin.edit_product');
        Route::post('/update_product/{id}', [ProductController::class, 'update_product'])->name('admin.update_product');
        Route::get('/delete_product/{id}', [ProductController::class, 'delete_product'])->name('admin.delete_product');

        //Order
        Route::get('/order', [OrderController::class, 'index'])->name('admin.order');
        Route::get('/delivered/{id}', [OrderController::class, 'delivered'])->name('admin.delivered');
        Route::get('/print_pdf/{id}', [OrderController::class, 'print_pdf'])->name('admin.print_pdf');
        Route::get('/search/order', [OrderController::class, 'searchOrder'])->name('admin.searchOrder');

        //Mail Address
        Route::get('/send-mail/{id}', [MailController::class, 'index'])->name('admin.send_mail');
    });
});
