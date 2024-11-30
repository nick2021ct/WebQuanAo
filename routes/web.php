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

Route::get('/view-cart', [OrderController::class, 'viewCart'])->name('viewCart');
Route::get('/check-out', [OrderController::class, 'getFormCheckOut'])->name('checkOut');
Route::get('/complete-payment', [OrderController::class, 'completePayment'])->name('completePayment');

