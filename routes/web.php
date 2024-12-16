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


//Product
Route::get('/list-product', [HomeController::class, 'listProduct'])->name('listProduct');
Route::get('/detail-product/{id}', [HomeController::class, 'detailProduct'])->name('detailProduct');
Route::get('/list-product-by-category/{id}', [HomeController::class, 'listProductByCategory'])->name('listProductByCategory');
Route::get('/list-product-by-brand/{id}', [HomeController::class, 'listProductByBrand'])->name('listProductByBrand');
Route::get('/search-product', [HomeController::class, 'searchProduct'])->name('searchProduct');
//Comment
Route::post('/comment', [CommentController::class, 'store'])->name('comment.store');

    //Product Management
    // Route::resource('/product', ProductController::class)->middleware('can:showProduct');
    Route::get('/product', [ProductController::class, 'index'])->middleware('can:showProduct')->name('product.index');
    Route::get('/product/create', [ProductController::class, 'create'])->middleware('can:addProduct')->name('product.create');
    Route::post('/product', [ProductController::class, 'store'])->middleware('can:addProduct')->name('product.store');
    Route::get('/product/{product}/edit', [ProductController::class, 'edit'])->middleware('can:updateProduct')->name('product.edit');
    Route::put('/product/{product}', [ProductController::class, 'update'])->middleware('can:updateProduct')->name('product.update');
    Route::delete('/product/{product}', [ProductController::class, 'destroy'])->middleware('can:deleteProduct')->name('product.destroy');
    Route::get('/product-restore/{id}', [ProductController::class, 'restore'])->middleware('can:deleteProduct')->name('admin.product.restore');

});

Route::get('/test', [OrderController::class, 'test']);