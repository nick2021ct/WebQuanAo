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
