<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Products\ProductController;
use App\Http\Controllers\Products\Carts\CartController;
use App\Http\Controllers\Orders\OrderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ProductController::class,'index'])->name('home');
Route::get('checkout', [ProductController::class,'checkout'])->name('checkout');
Route::get('cart',[CartController::class,'index'])->name('getCart');
Route::post('cart/add',[CartController::class,'storeItem'])->name('addToCart');
Route::delete('cart/{itemId}/delete',[CartController::class,'deleteItem'])->name('removeFromCart');
Route::post('order/store', [OrderController::class,'store'])->name('storeOrder');


