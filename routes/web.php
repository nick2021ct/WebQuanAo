<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::post('/add-to-cart/{id}', [CartController::class, 'addToCart'])->name('addToCart');
Route::get('/view-cart', [CartController::class, 'viewCart'])->name('viewCart');
Route::get('/delete-product-in-cart/{id}', [CartController::class, 'deleteInCart'])->name('deleteInCart');
Route::post('/update-cart', [CartController::class, 'updateCart'])->name('updateCart');
//Coupon
Route::post('/discount-code', [OrderController::class, 'discountCode'])->name('discountCode');
//Checkout (with VNPay)
Route::get('/check-out', [OrderController::class, 'getFormCheckOut'])->name('checkOut');
Route::post('/check-out', [OrderController::class, 'submitFormCheckOut'])->name('checkOut');
Route::get('/complete-payment', [OrderController::class, 'completePayment'])->name('completePayment');

