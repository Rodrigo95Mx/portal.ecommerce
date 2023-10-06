<?php

use App\Http\Controllers\EcommerceController;
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

Route::get('/', [EcommerceController::class, 'index'])->name('index');
Route::get('/checkout', [EcommerceController::class, 'checkout'])->name('checkout');
Route::get('/profile', [EcommerceController::class, 'purchaseHistory'])->name('profile');
