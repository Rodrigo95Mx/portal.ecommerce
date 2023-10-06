<?php

use App\Http\Controllers\EcommerceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/registro', [EcommerceController::class, 'register'])->name('register');
Route::post('/login', [EcommerceController::class, 'login'])->name('login');
Route::post('/logout', [EcommerceController::class, 'logout'])->name('logout');
Route::post('/carrito/actualizar', [EcommerceController::class, 'updateShoppingCartDataBase'])->name('updateShoppingCartDataBase');
Route::post('/carrito/comprar', [EcommerceController::class, 'buyCartList'])->name('buyCartList');
Route::post('/compras/detalle', [EcommerceController::class, 'purchaseDetails'])->name('purchaseDetails');
Route::post('/chat/mensaje', [EcommerceController::class, 'sendMessageChat'])->name('sendMessageChat');