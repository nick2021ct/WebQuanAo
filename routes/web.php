<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProductController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

//Product
Route::get('/list-product', [HomeController::class, 'listProduct'])->name('listProduct');
Route::get('/detail-product/{id}', [HomeController::class, 'detailProduct'])->name('detailProduct');
Route::get('/list-product-by-category/{id}', [HomeController::class, 'listProductByCategory'])->name('listProductByCategory');
Route::get('/list-product-by-brand/{id}', [HomeController::class, 'listProductByBrand'])->name('listProductByBrand');
Route::get('/search-product', [HomeController::class, 'searchProduct'])->name('searchProduct');
//Comment
Route::post('/comment', [CommentController::class, 'store'])->name('comment.store');

Route::group(['prefix' => 'admin', 'middleware' => 'AdminLogin'], function () {
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
