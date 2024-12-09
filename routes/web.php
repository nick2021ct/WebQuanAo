<?php

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

Route::get('/', function () {
    return view('welcome');
});


// loggin out user
Route::get('/login', [AccountController::class, 'getFormLogin'])->name('login');
Route::post('/login', [AccountController::class, 'submitFormLogin'])->name('login');

Route::get('/logout', [AccountController::class, 'logout'])->name('logout');
    
Route::get('/list-product', [HomeController::class, 'listProduct'])->name('listProduct');
Route::get('/detail-product/{id}', [HomeController::class, 'detailProduct'])->name('detailProduct');
Route::get('/list-product-by-category/{id}', [HomeController::class, 'listProductByCategory'])->name('listProductByCategory');
Route::get('/list-product-by-brand/{id}', [HomeController::class, 'listProductByBrand'])->name('listProductByBrand');
Route::get('/search-product', [HomeController::class, 'searchProduct'])->name('searchProduct');

Route::get('admin/login', [AccountControllerAdmin::class, 'getFormLogin'])->name('adminLogin');
Route::post('admin/login', [AccountControllerAdmin::class, 'submitFormLogin'])->name('adminLogin');

Route::group(['prefix' => 'admin', 'middleware' => 'AdminLogin'], function () {
    Route::get('/product', [ProductController::class, 'index'])->middleware('can:showProduct')->name('product.index');
    Route::get('/product/create', [ProductController::class, 'create'])->middleware('can:addProduct')->name('product.create');
    Route::post('/product', [ProductController::class, 'store'])->middleware('can:addProduct')->name('product.store');

    Route::get('/product/{product}/edit', [ProductController::class, 'edit'])->middleware('can:updateProduct')->name('product.edit');
    Route::put('/product/{product}', [ProductController::class, 'update'])->middleware('can:updateProduct')->name('product.update');
    Route::delete('/product/{product}', [ProductController::class, 'destroy'])->middleware('can:deleteProduct')->name('product.destroy');
    Route::get('/product-restore/{id}', [ProductController::class, 'restore'])->middleware('can:deleteProduct')->name('admin.product.restore');

    Route::get('/account', [AccountControllerAdmin::class, 'index'])->middleware('can:showAccount')->name('account.index');
    Route::get('/account/create', [AccountControllerAdmin::class, 'create'])->middleware('can:addAccount')->name('account.create');
    Route::post('/account', [AccountControllerAdmin::class, 'store'])->middleware('can:addAccount')->name('account.store');
    Route::get('/account/{account}/edit', [AccountControllerAdmin::class, 'edit'])->middleware('can:updateAccount')->name('account.edit');
    Route::put('/account/{account}', [AccountControllerAdmin::class, 'update'])->middleware('can:updateAccount')->name('account.update');
    Route::delete('/account/{account}', [AccountControllerAdmin::class, 'destroy'])->middleware('can:deleteAccount')->name('account.destroy');
    Route::get('/create-staff', [AccountControllerAdmin::class, 'getFormCreateStaff'])->name('admin.account.createStaff');
    Route::post('/create-staff', [AccountControllerAdmin::class, 'submitFormCreateStaff'])->name('admin.account.createStaff');
    Route::get('/account-unblock/{id}', [AccountControllerAdmin::class, 'unblock'])->middleware('can:deleteAccount')->name('admin.account.unblock');
})