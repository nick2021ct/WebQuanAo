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
    Route::get('/order-change-status/{id}',[OrderController::class,'updateStatusOrder'])->name('updateStatusOrder');
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
    // Route::resource('/category', CategoryController::class)->middleware('can:showCategory');
    Route::get('/category', [CategoryController::class, 'index'])->middleware('can:showCategory')->name('category.index');
    Route::get('/category/create', [CategoryController::class, 'create'])->middleware('can:addCategory')->name('category.create');
    Route::post('/category', [CategoryController::class, 'store'])->middleware('can:addCategory')->name('category.store');
    Route::get('/category/{category}/edit', [CategoryController::class, 'edit'])->middleware('can:updateCategory')->name('category.edit');
    Route::put('/category/{category}', [CategoryController::class, 'update'])->middleware('can:updateCategory')->name('category.update');
    Route::delete('/category/{category}', [CategoryController::class, 'destroy'])->middleware('can:deleteCategory')->name('category.destroy');
    Route::get('/category-restore/{id}', [CategoryController::class, 'restore'])->middleware('can:deleteCategory')->name('admin.category.restore');
    // Blog  Management
    Route::get('/blog', [BlogControllerAdmin::class, 'index'])->middleware('can:showBlog')->name('blog.index');
    Route::get('/blog/create', [BlogControllerAdmin::class, 'create'])->middleware('can:addBlog')->name('blog.create');
    Route::post('/blog', [BlogControllerAdmin::class, 'store'])->middleware('can:addBlog')->name('blog.store');
    Route::get('/blog/{blog}/edit', [BlogControllerAdmin::class, 'edit'])->middleware('can:updateBlog')->name('blog.edit');
    Route::put('/blog/{blog}', [BlogControllerAdmin::class, 'update'])->middleware('can:updateBlog')->name('blog.update');
    Route::delete('/blog/{blog}', [BlogControllerAdmin::class, 'destroy'])->middleware('can:deleteBlog')->name('blog.destroy');
    Route::get('/blog-restore/{id}', [BlogControllerAdmin::class, 'restore'])->middleware('can:deleteBlog')->name('admin.blog.restore');
    //Brand Management
    // Route::resource('/brand', BrandController::class)->middleware('can:showBrand');
    Route::get('/brand', [BrandController::class, 'index'])->middleware('can:showBrand')->name('brand.index');
    Route::get('/brand/create', [BrandController::class, 'create'])->middleware('can:addBrand')->name('brand.create');
    Route::post('/brand', [BrandController::class, 'store'])->middleware('can:addBrand')->name('brand.store');
    Route::get('/brand/{brand}/edit', [BrandController::class, 'edit'])->middleware('can:updateBrand')->name('brand.edit');
    Route::put('/brand/{brand}', [BrandController::class, 'update'])->middleware('can:updateBrand')->name('brand.update');
    Route::delete('/brand/{brand}', [BrandController::class, 'destroy'])->middleware('can:deleteBrand')->name('brand.destroy');
    Route::get('/brand-restore/{id}', [BrandController::class, 'restore'])->middleware('can:deleteBrand')->name('admin.brand.restore');

    //Product Management
    // Route::resource('/product', ProductController::class)->middleware('can:showProduct');
    Route::get('/product', [ProductController::class, 'index'])->middleware('can:showProduct')->name('product.index');
    Route::get('/product/create', [ProductController::class, 'create'])->middleware('can:addProduct')->name('product.create');
    Route::post('/product', [ProductController::class, 'store'])->middleware('can:addProduct')->name('product.store');
    Route::get('/product/{product}/edit', [ProductController::class, 'edit'])->middleware('can:updateProduct')->name('product.edit');
    Route::put('/product/{product}', [ProductController::class, 'update'])->middleware('can:updateProduct')->name('product.update');
    Route::delete('/product/{product}', [ProductController::class, 'destroy'])->middleware('can:deleteProduct')->name('product.destroy');
    Route::get('/product-restore/{id}', [ProductController::class, 'restore'])->middleware('can:deleteProduct')->name('admin.product.restore');

    //Banner Management
    // Route::resource('/banner', BannerController::class)->middleware('can:showBanner');
    Route::get('/banner', [BannerController::class, 'index'])->middleware('can:showBanner')->name('banner.index');
    Route::get('/banner/create', [BannerController::class, 'create'])->middleware('can:addBanner')->name('banner.create');
    Route::post('/banner', [BannerController::class, 'store'])->middleware('can:addBanner')->name('banner.store');
    Route::get('/banner/{banner}/edit', [BannerController::class, 'edit'])->middleware('can:updateBanner')->name('banner.edit');
    Route::put('/banner/{banner}', [BannerController::class, 'update'])->middleware('can:updateBanner')->name('banner.update');
    Route::delete('/banner/{banner}', [BannerController::class, 'destroy'])->middleware('can:deleteBanner')->name('banner.destroy');
    //Voucher Management
    // Route::resource('/voucher', VoucherController::class)->middleware('can:showVoucher');
    Route::get('/voucher', [VoucherController::class, 'index'])->middleware('can:showVoucher')->name('voucher.index');
    Route::get('/voucher/create', [VoucherController::class, 'create'])->middleware('can:addVoucher')->name('voucher.create');
    Route::post('/voucher', [VoucherController::class, 'store'])->middleware('can:addVoucher')->name('voucher.store');
    Route::get('/voucher/{voucher}/edit', [VoucherController::class, 'edit'])->middleware('can:updateVoucher')->name('voucher.edit');
    Route::put('/voucher/{voucher}', [VoucherController::class, 'update'])->middleware('can:updateVoucher')->name('voucher.update');
    Route::delete('/voucher/{voucher}', [VoucherController::class, 'destroy'])->middleware('can:deleteVoucher')->name('voucher.destroy');
    //Account Management
    // Route::resource('/account', AccountControllerAdmin::class)->middleware('can:showAccount');
    Route::get('/account', [AccountControllerAdmin::class, 'index'])->middleware('can:showAccount')->name('account.index');
    Route::get('/account/create', [AccountControllerAdmin::class, 'create'])->middleware('can:addAccount')->name('account.create');
    Route::post('/account', [AccountControllerAdmin::class, 'store'])->middleware('can:addAccount')->name('account.store');
    Route::get('/account/{account}/edit', [AccountControllerAdmin::class, 'edit'])->middleware('can:updateAccount')->name('account.edit');
    Route::put('/account/{account}', [AccountControllerAdmin::class, 'update'])->middleware('can:updateAccount')->name('account.update');
    Route::delete('/account/{account}', [AccountControllerAdmin::class, 'destroy'])->middleware('can:deleteAccount')->name('account.destroy');
    Route::get('/create-staff', [AccountControllerAdmin::class, 'getFormCreateStaff'])->name('admin.account.createStaff');
    Route::post('/create-staff', [AccountControllerAdmin::class, 'submitFormCreateStaff'])->name('admin.account.createStaff');
    Route::get('/account-unblock/{id}', [AccountControllerAdmin::class, 'unblock'])->middleware('can:deleteAccount')->name('admin.account.unblock');

    // Order Management
    Route::get('/order', [BillControllerAdmin::class, 'index'])->name('bill.index');
    Route::get('/order-detail/{id}', [BillControllerAdmin::class, 'detailBill'])->name('bill.detail');
    Route::post('/order-update/{id}', [BillControllerAdmin::class, 'updateBill'])->name('bill.update');
    Route::get('/order-invoice/{id}', [BillControllerAdmin::class, 'invoice'])->name('invoice');

});


