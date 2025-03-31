<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/get/categories', [CategoryController::class, 'getCategories']);
Route::get('/get/products', [ProductController::class, 'getProducts']);
Route::get('/get/products/{id}', [ProductController::class, 'getProductById']);
Route::get('/get/categories/{id}', [CategoryController::class, 'getCategoryById']);
Route::get('/get/orders', [OrderController::class, 'getOrders']);
Route::get('/get/orders/{id}', [OrderController::class, 'getOrderById']);
Route::get('/get/carts', [CartController::class, 'getCarts']);
Route::get('/get/carts/{id}', [CartController::class, 'getCartById']);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('products', ProductController::class);
    Route::apiResource('users', UserController::class);
    Route::apiResource('orders', OrderController::class);
    Route::apiResource('carts', CartController::class);
});
