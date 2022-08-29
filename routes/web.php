<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ThankYouController;
use App\Http\Controllers\ShoppingCartController;
use App\Http\Controllers\StripeCheckoutController;

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

Route::get('/', function () {
    return view('welcome');
});

// Make a route to the product controller using the "get" function.
Route::get('/products', [ProductController::class, 'index'])
    ->name('products.index');

// Shopping Cart
Route::get('/shoppingCart', ShoppingCartController::class)
        ->name('cart.index');

// Checkout with Stripe "Payement" To display it
Route::get('/checkout', [StripeCheckoutController::class, 'create']);

// Moving on to the payment method
Route::post('/paymentIntent', [StripeCheckoutController::class, 'paymentIntent']);

//
Route::post('/saveOrder', OrderController::class)
        ->name('orders.save');


Route::get('/thankYou', ThankYouController::class)
        ->name('thanks.index');
//
Route::get('/clear', function () {
    \Cart::session(auth()->user()->id)->clear();
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
