<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SliderApiController;
use App\Http\Controllers\ProductApiController;
use App\Http\Controllers\CategoryApiController;
use App\Http\Controllers\LoginApiController;
use App\Http\Controllers\CartApiController;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::get('slider', [SliderApiController::class, 'index']);

Route::get('category', [CategoryApiController::class, 'index']);

Route::get('product', [ProductApiController::class, 'index']);
Route::post('product2', [ProductApiController::class, 'getProId']);
Route::get('product/get-one/{id}', [ProductApiController::class, 'getOne']);
Route::post('search', [ProductApiController::class, 'search']);
Route::get('search-name', [ProductApiController::class, 'search2']);


Route::post('upload', [ProductApiController::class, 'upload']);

Route::post('loginapi', [LoginApiController::class, 'login']);
Route::post('registerapi', [LoginApiController::class, 'register']);
Route::post('account/change-password', [LoginApiController::class, 'changePassword']);

Route::get('cart/{id}', [CartApiController::class, 'index']);
Route::post('cart/add-cart', [CartApiController::class, 'addCart']);
Route::post('cart/update-status-cart', [CartApiController::class, 'updateStatusCart']);
Route::post('cart/delete-cart', [CartApiController::class, 'deleteCart']);
Route::post('cart/reset-all-status-cart', [CartApiController::class, 'resetAllSatusCart']);
Route::post('cart/up-quantity', [CartApiController::class, 'updateQuantity']);
Route::post('cart/select-allcart', [CartApiController::class, 'selectAll']);
Route::get('cart/cart-checkout/{id}', [CartApiController::class, 'cart_checkout']);

Route::get('product-sales', [ProductApiController::class, 'getProduct_sale']);
Route::get('account/{id}', [LoginApiController::class, 'getAccount']);
Route::post('account/update-info', [LoginApiController::class, 'updateInfo']);

Route::post('cart/pay', [CartApiController::class, 'payCart']);
Route::post('cart/get-order', [CartApiController::class, 'getOrder']);
Route::post('cart/cancel-order', [CartApiController::class, 'cancelOrder']);

Route::post('product/comment', [ProductApiController::class, 'getComment']);
// Route::post('product/check-comment', [ProductApiController::class, 'checkComment']);
Route::post('product/add-comment', [ProductApiController::class, 'addComment']);

Route::get('product/wishlist/{accountid}', [ProductApiController::class, 'getWishList']);
Route::post('product/add-wishlist', [ProductApiController::class, 'add_WishList']);
Route::post('product/check-wishlist', [ProductApiController::class, 'check_Wishlist']);
