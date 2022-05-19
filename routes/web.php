<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProducerController;

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

Route::resource('producers', ProducerController::class)->except(['show']);
Route::resource('customers', CustomerController::class)->except(['show']);
Route::resource('admin', AdminController::class)->except(['show']);
Route::resource('blogs', BlogController::class)->except(['show']);
Route::resource('products', ProductController::class)->except(['show']);
Route::resource('orders', OrderController::class)->except(['show']);