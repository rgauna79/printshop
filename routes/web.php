<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\DiscountCodeController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController as ProductFront;
use App\Http\Controllers\Admin\ShippingChargeController;
use App\Http\Controllers\Admin\UserInfoController;
use App\Http\Controllers\UserController;

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


// Admin Routes
Route::get('admin', [AuthController::class, 'login_admin']);
Route::post('admin', [AuthController::class, 'auth_login_admin']);
Route::get('admin/logout', [AuthController::class, 'logout_admin']);

Route::group(['middleware' => 'admin'], function () {

    Route::get('admin/dashboard', [DashboardController::class, 'dashboard']);

    Route::get('admin/admin/list', [AdminController::class, 'list']);
    Route::get('admin/admin/add', [AdminController::class, 'add']);
    Route::post('admin/admin/add', [AdminController::class, 'insert']);
    Route::get('admin/admin/edit/{id}', [AdminController::class, 'edit']);
    Route::post('admin/admin/edit/{id}', [AdminController::class, 'update']);
    Route::get('admin/admin/delete/{id}', [AdminController::class, 'delete']);

    Route::get('admin/category/list', [CategoryController::class, 'list']);
    Route::get('admin/category/add', [CategoryController::class, 'add']);
    Route::post('admin/category/add', [CategoryController::class, 'insert']);
    Route::get('admin/category/edit/{id}', [CategoryController::class, 'edit']);
    Route::post('admin/category/edit/{id}', [CategoryController::class, 'update']);
    Route::get('admin/category/delete/{id}', [CategoryController::class, 'delete']);
   
    Route::get('admin/subcategory/list', [SubCategoryController::class, 'list']);
    Route::get('admin/subcategory/add', [SubCategoryController::class, 'add']);
    Route::post('admin/subcategory/add', [SubCategoryController::class, 'insert']);
    Route::get('admin/subcategory/edit/{id}', [SubCategoryController::class, 'edit']);
    Route::post('admin/subcategory/edit/{id}', [SubCategoryController::class, 'update']);
    Route::get('admin/subcategory/delete/{id}', [SubCategoryController::class, 'delete']);
    
    Route::post('admin/get_sub_category', [SubCategoryController::class, 'get_sub_category']);


    Route::get('admin/product/list', [ProductController::class, 'list']);
    Route::get('admin/product/add', [ProductController::class, 'add']);
    Route::post('admin/product/add', [ProductController::class, 'insert']);
    Route::get('admin/product/edit/{id}', [ProductController::class, 'edit']);
    Route::post('admin/product/edit/{id}', [ProductController::class, 'update']);
    
    Route::get('admin/product/image_delete/{id}', [ProductController::class, 'image_delete']);
    Route::post('admin/product_image_sortable', [ProductController::class, 'product_image_sortable']);

    Route::get('admin/brand/list', [BrandController::class, 'list']);
    Route::get('admin/brand/add', [BrandController::class, 'add']);
    Route::post('admin/brand/add', [BrandController::class, 'insert']);
    Route::get('admin/brand/edit/{id}', [BrandController::class, 'edit']);
    Route::post('admin/brand/edit/{id}', [BrandController::class, 'update']);
    Route::get('admin/brand/delete/{id}', [BrandController::class, 'delete']);

    Route::get('admin/color/list', [ColorController::class, 'list']);
    Route::get('admin/color/add', [ColorController::class, 'add']);
    Route::post('admin/color/add', [ColorController::class, 'insert']);
    Route::get('admin/color/edit/{id}', [ColorController::class, 'edit']);
    Route::post('admin/color/edit/{id}', [ColorController::class, 'update']);
    Route::get('admin/color/delete/{id}', [ColorController::class, 'delete']);

    Route::get('admin/discountcode/list', [DiscountCodeController::class, 'list']);
    Route::get('admin/discountcode/add', [DiscountCodeController::class, 'add']);
    Route::post('admin/discountcode/add', [DiscountCodeController::class, 'insert']);
    Route::get('admin/discountcode/edit/{id}', [DiscountCodeController::class, 'edit']);
    Route::post('admin/discountcode/edit/{id}', [DiscountCodeController::class, 'update']);
    Route::get('admin/discountcode/delete/{id}', [DiscountCodeController::class, 'delete']);

    Route::get('admin/shipping_charge/list', [ShippingChargeController::class, 'list']);
    Route::get('admin/shipping_charge/add', [ShippingChargeController::class, 'add']);
    Route::post('admin/shipping_charge/add', [ShippingChargeController::class, 'insert']);
    Route::get('admin/shipping_charge/edit/{id}', [ShippingChargeController::class, 'edit']);
    Route::post('admin/shipping_charge/edit/{id}', [ShippingChargeController::class, 'update']);
    Route::get('admin/shipping_charge/delete/{id}', [ShippingChargeController::class, 'delete']);

    Route::get('admin/orders/list', [OrderController::class, 'list']);
    Route::get('admin/orders/detail/{id}', [OrderController::class, 'detail']);
});

// User Routes
Route::get('/', [HomeController::class, 'home']);

Route::post('/register', [AuthController::class, 'insert_user'])->name('register');
Route::get('/activate/{id}', [AuthController::class, 'activate_email']);

Route::post('/login_user', [AuthController::class, 'login_user']);
Route::get('/logout', [AuthController::class, 'logout_user']);
Route::get('/forgot_password', [AuthController::class, 'forgot_password']);
Route::post('/forgot_password', [AuthController::class, 'user_forgot_password']);
Route::get('reset/{token}', [AuthController::class, 'reset_password']);
Route::post('reset/{token}', [AuthController::class, 'user_reset']);



Route::group(['middleware' => 'user'], function () {
    Route::get('/my-account', [UserController::class, 'my_account']);
   
    Route::get('/my-account/address', [UserInfoController::class, 'get_user_address']);
    Route::post('/my-account/update_address', [UserInfoController::class, 'update_user_address']);
    Route::post('/my-account/update_profile', [UserInfoController::class, 'update_user_profile']);
});


// Shopping Cart Routes
Route::post('product/add_to_cart', [PaymentController::class, 'add_to_cart']);
Route::get('cart', [PaymentController::class, 'cart']);
Route::get('cart/remove/{id}', [PaymentController::class, 'cart_delete']);
Route::post('cart/update', [PaymentController::class, 'cart_update']);

Route::get('checkout', [PaymentController::class, 'checkout']);
Route::post('checkout/apply_discount_code', [PaymentController::class, 'apply_discount_code']);
Route::post('checkout/place_order', [PaymentController::class, 'place_order']);
Route::get('checkout/payment', [PaymentController::class, 'checkout_payment']);
Route::get('paypal/success-payment', [PaymentController::class, 'paypal_success_payment']);
Route::get('stripe/payment-success', [PaymentController::class, 'stripe_payment_success']);


// Product Search and filter Routes
Route::get('search', [ProductFront::class, 'getProductSearch']);
Route::post('get_filter_product_ajax', [ProductFront::class, 'getFilterProductAjax']);
Route::get('{category?}/{subCategory?}', [ProductFront::class, 'getCategory']);

