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
    
})