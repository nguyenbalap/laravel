<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopingCartController;
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

Route::get('/products', [ProductController::class, 'allProducts']);
Route::post('/register', [CustomerController::class, 'store']);
Route::post('/auth', [CustomerController::class, 'process_login']);
Route::post('/shopping-cart', [ShopingCartController::class, 'get_user_cart']);
Route::post('/add-new-item', [ShopingCartController::class, 'add_new_item']);
Route::put('/update-quantity/{id}', [ShopingCartController::class, 'update']);
Route::post('/product-details', [ProductController::class, 'product_details']);
Route::post('/user-shopping-cart', [ShopingCartController::class, 'index']);
Route::post('/orders', [OrderController::class, 'store']);

Route::post('/products/page/{id}', [ProductController::class, 'process_paging']);
Route::get('/blogs', [BlogController::class, 'overview']);
Route::post('/blogs/info', [BlogController::class, 'blog_detail']);




Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});