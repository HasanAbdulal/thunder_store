<?php

use App\Http\Controllers\Api\CartController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Middleware access through auth:sanctum
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Increase the number of products in the user's basket
    Route::get('products/increase/{id}', [CartController::class, 'increase']);

    // Decrease the number of products in the user's basket
    Route::get('products/decrease/{id}', [CartController::class, 'decrease']);

    // Amount of products counted
    Route::get('products/count', [CartController::class, 'count'])
            ->name('products.count');

    //
    Route::apiResource('products', CartController::class);
});
