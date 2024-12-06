<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AccountControllerAdmin;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\BillControllerAdmin;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BlogControllerAdmin;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
// use App\Http\Controllers\VoucherController;
use App\Http\Controllers\VoucherController;
use Illuminate\Foundation\Console\AboutCommand;

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

Route::get('/', [HomeController::class, 'home'])->name('home');
//About

Route::get('/about', [AboutController::class, 'index'])->name('about');
//Product
Route::get('/list-product', [HomeController::class, 'listProduct'])->name('listProduct');
Route::get('/detail-product/{id}', [HomeController::class, 'detailProduct'])->name('detailProduct');
Route::get('/list-product-by-category/{id}', [HomeController::class, 'listProductByCategory'])->name('listProductByCategory');
Route::get('/list-product-by-brand/{id}', [HomeController::class, 'listProductByBrand'])->name('listProductByBrand');
Route::get('/search-product', [HomeController::class, 'searchProduct'])->name('searchProduct');
//Comment
Route::post('/comment', [CommentController::class, 'store'])->name('comment.store');
//Blog
Route::get('/list-blog', [BlogController::class, 'index'])->name('listBlog');
Route::get('/blog-detail/{blog}', [BlogController::class, 'show'])->name('detailBlog');
//Login 
Route::get('/login', [AccountController::class, 'getFormLogin'])->name('login');
Route::post('/login', [AccountController::class, 'submitFormLogin'])->name('login');
//Register
Route::get('/register', [AccountController::class, 'getFormRegister'])->name('register');
Route::post('/register', [AccountController::class, 'submitFormRegister'])->name('register');
//Logout
Route::get('/logout', [AccountController::class, 'logout'])->name('logout');
//Forgot password
Route::get('/forgot-password', [AccountController::class, 'getFormForgotPassword'])->name('forgotPassword');
Route::post('/forgot-password', [AccountController::class, 'submitFormForgotPassword'])->name('forgotPassword');
Route::get('/new-password/{id}/{token}', [AccountController::class, 'getFormNewPassword'])->name('newPassword');
Route::post('/change-password/{id}', [AccountController::class, 'submitFormNewPassword'])->name('changePassword');
//Verification email
Route::get('/verifi-email/{email}/{token}', [AccountController::class, 'verifiEmail'])->name('verifiEmail');
// Order
Route::group(['middleware' => 'auth'], function () {
    //Cart
    Route::post('/add-to-cart/{id}', [OrderController::class, 'addToCart'])->name('addToCart');
    Route::get('/view-cart', [OrderController::class, 'viewCart'])->name('viewCart');
    Route::get('/delete-product-in-cart/{id}', [OrderController::class, 'deleteInCart'])->name('deleteInCart');
    Route::post('/update-cart', [OrderController::class, 'updateCart'])->name('updateCart');
    //Coupon
    Route::post('/discount-code', [OrderController::class, 'discountCode'])->name('discountCode');
    //Checkout (with VNPay)
    Route::get('/check-out', [OrderController::class, 'getFormCheckOut'])->name('checkOut');
    Route::post('/check-out', [OrderController::class, 'submitFormCheckOut'])->name('checkOut');
    Route::get('/complete-payment', [OrderController::class, 'completePayment'])->name('completePayment');
    //Order list
    Route::get('/order', [OrderController::class, 'listOrder'])->name('listOrder');
    Route::get('/order-detail/{id}', [OrderController::class, 'detailOrder'])->name('detailOrder');
});
//Login admin
Route::get('admin/login', [AccountControllerAdmin::class, 'getFormLogin'])->name('adminLogin');
Route::post('admin/login', [AccountControllerAdmin::class, 'submitFormLogin'])->name('adminLogin');
//Logout admin
Route::post('admin/logout', [AccountControllerAdmin::class, 'submitFormLogout'])->name('adminLogout');
// Admin
Route::group(['prefix' => 'admin', 'middleware' => 'AdminLogin'], function () {
    Route::get('/', [DashboardController::class, 'chart_dashboard'])->name('admin.dashboard');
    Route::get('/dashboard', [DashboardController::class, 'chart_dashboard'])->name('admin.dashboard');
    Route::post('/filter-by-date', [DashboardController::class, 'filter_by_date'])->name('filter_by_date');
    //Category Management
    //Product Management
    // Route::resource('/product', ProductController::class)->middleware('can:showProduct');
    Route::get('/product', [ProductController::class, 'index'])->middleware('can:showProduct')->name('product.index');
    Route::get('/product/create', [ProductController::class, 'create'])->middleware('can:addProduct')->name('product.create');
    Route::post('/product', [ProductController::class, 'store'])->middleware('can:addProduct')->name('product.store');
    Route::get('/product/{product}/edit', [ProductController::class, 'edit'])->middleware('can:updateProduct')->name('product.edit');
    Route::put('/product/{product}', [ProductController::class, 'update'])->middleware('can:updateProduct')->name('product.update');
    Route::delete('/product/{product}', [ProductController::class, 'destroy'])->middleware('can:deleteProduct')->name('product.destroy');
    Route::get('/product-restore/{id}', [ProductController::class, 'restore'])->middleware('can:deleteProduct')->name('admin.product.restore');

    Route::get('/order', [BillControllerAdmin::class, 'index'])->name('bill.index');
    Route::get('/order-detail/{id}', [BillControllerAdmin::class, 'detailBill'])->name('bill.detail');
    Route::post('/order-update/{id}', [BillControllerAdmin::class, 'updateBill'])->name('bill.update');
    Route::get('/order-invoice/{id}', [BillControllerAdmin::class, 'invoice'])->name('invoice');
});

Route::get('/test', [OrderController::class, 'test']);