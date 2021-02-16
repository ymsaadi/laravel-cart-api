<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\ProductController;
use App\Http\Resources\ProductResource;
use App\Models\Product;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


//Route::get('/products', [ProductController::class, 'index']);
//
//Route::get('/product/{id}', [ProductController::class, 'find']);
//
//Route::post('/product', [ProductController::class, 'store']);
//
//Route::put('/product/{id}', [ProductController::class, 'update']);
//
//Route::delete('/product/{id}', [ProductController::class, 'delete']);



Route::get('/carts', [CartController::class, 'index']);

Route::post('/cart', [CartController::class, 'store']);

Route::post('/cart/{id}', [CartController::class, 'addItemToCart']);

Route::get('/cart/{id}', [CartController::class, 'getCart']);

Route::post('/cart/{id}/discount', [CartController::class, 'attachDiscount']);

Route::put('/cart/{id}', [CartController::class, 'updateCartItem']);

Route::delete('/cart/{id}', [CartController::class, 'deleteItemFromCart']);


//Route::get('/cartItems', [CartItemController::class, 'index']);
//
//Route::post('/cartItem', [CartItemController::class, 'store']);

