<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SendMailController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

Route::get('/', [HomeController::class, 'index']);
Route::get('/trang-chu', [HomeController::class, 'index']);
Route::get('/show-all-product', [HomeController::class, 'show_all_product']);
// search
Route::get('/search', [HomeController::class, 'customer_search']);

// Admin route
Route::group(['prefix' => '/account', 'middleware' => 'AdminMiddleware'], function () {
    Route::get('/', [AdminController::class, 'index'])->withoutMiddleware('AdminMiddleware');
    Route::get('/admin', [AdminController::class, 'index'])->withoutMiddleware('AdminMiddleware');
    Route::post('/admin-dashboard', [AdminController::class, 'dashboard'])->withoutMiddleware('AdminMiddleware');
    Route::get('/dashboard', [AdminController::class, 'show_dashboard']);
    Route::get('/logout', [AdminController::class, 'logout']);
});

// Order route
Route::group(['prefix'=>'/','middleware'=>'AdminMiddleware'],function() {
    Route::get('manage-order', [AdminController::class, 'manage_order']);
    Route::get('/show-detail-order/{id}',[AdminController::class,'show_detail_order']);
    Route::get('delete-order',[AdminController::class,'delete_order']);
});

// Category brand
Route::group(['prefix' => '/', 'middleware' => 'AdminMiddleware'], function () {
    Route::get('add-category-product', [CategoryController::class, 'add_category_product']);
    Route::get('all-category-product', [CategoryController::class, 'all_category_product']);
    Route::post('save-category-product', [CategoryController::class, 'save_category_product']);
    Route::get('active-category-product/{id}', [CategoryController::class, 'active_category_product']);
    Route::get('unactive-category-product/{id}', [CategoryController::class, 'unactive_category_product']);
    Route::get('show-detail-category-product/{id}', [CategoryController::class, 'show_detail_category_product']);
    Route::post('update-category-product/{id}', [CategoryController::class, 'update_category_product']);
    Route::get('delete-category-product/{id}', [CategoryController::class, 'delete_category_product']);
});

// Brand route
Route::group(['prefix' => '/', 'middleware' => 'AdminMiddleware'], function () {
    Route::get('add-brand-product', [BrandController::class, 'add_brand_product']);
    Route::get('all-brand-product', [BrandController::class, 'all_brand_product']);
    Route::post('save-brand-product', [BrandController::class, 'save_brand_product']);
    Route::get('active-brand-product/{id}', [BrandController::class, 'active_brand_product']);
    Route::get('unactive-brand-product/{id}', [BrandController::class, 'unactive_brand_product']);
    Route::get('show-detail-brand-product/{id}', [BrandController::class, 'show_detail_brand_product']);
    Route::post('update-brand-product/{id}', [BrandController::class, 'update_brand_product']);
    Route::get('delete-brand-product/{id}', [BrandController::class, 'delete_brand_product']);
});

// Product route
Route::group(['prefix' => '/', 'middleware' => 'AdminMiddleware'], function () {
    Route::get('add-product', [ProductController::class, 'add_product']);
    Route::get('all-product', [ProductController::class, 'all_product']);
    Route::post('save-product', [ProductController::class, 'save_product']);
    Route::get('show-detail-product/{id}', [ProductController::class, 'show_detailproduct']);
    Route::post('update-product/{id}', [ProductController::class, 'update_product']);
    Route::get('delete-product/{id}', [ProductController::class, 'delete_product']);
    Route::get('active-product/{id}', [ProductController::class, 'active_product']);
    Route::get('unactive-product/{id}', [ProductController::class, 'unactive_product']);
    Route::get('admin-search-product', [ProductController::class, 'admin_search_product']);
});

// Show product
Route::get('show-product-of-category/{id}', [CategoryController::class, 'show_product_of_category']);
Route::get('show-product-of-brand/{id}', [BrandController::class, 'show_product_of_brand']);
Route::get('product-details/{id}/{category_id}', [ProductController::class, 'product_details']);


//cart
Route::post('save-cart', [CartController::class, 'save_cart']);
Route::get('show-cart', [CartController::class, 'show_cart']);
Route::get('delete-cart/{rowId}', [Cartcontroller::class, 'delete_cart']);
Route::get('update-cart', [Cartcontroller::class, 'update_cart']);

//checkout
Route::get('login-checkout', [CheckoutController::class, 'login_checkout']);
Route::get('logout-checkout', [CheckoutController::class, 'logout_checkout']);
Route::post('add-customer', [CheckoutController::class, 'add_customer']);
Route::get('checkout', [CheckoutController::class, 'checkout'])->middleware('CustomerMiddleware');
Route::post('save-checkout-customer', [CheckoutController::class, 'save_checkout_customer']);
Route::get('payment', [CheckoutController::class, 'payment']);
Route::post('login-customer', [CheckoutController::class, 'login_customer']);
Route::post('/order-place', [CheckoutController::class, 'order_place']);

Route::get('/contact-us', [ContactController::class, 'contact_us']);

// send mail
Route::get('/send-mail', [SendMailController::class, 'send_mail']);

// login facebook
Route::get('/chinh-sach-rieng-tu', function () {
    return 'Chính sách riêng tư';
});

Route::get('/auth/facebook', [LoginController::class, 'redirect_to_facebook']);
Route::get('/auth/facebook/callback', [LoginController::class, 'callback_facebook']);
