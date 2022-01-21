<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\CategoryController;
use GuzzleHttp\Middleware;
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



Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('home_admin');
    Route::get('/add-user', [AdminController::class, 'addUser_get'])->name('add-user-get');
    Route::post('/add-user', [AdminController::class, 'addUser_post'])->name('add-user-post');
    Route::get('/delete', [AdminController::class, 'deleteUser'])->name('delete-user');
    Route::get('/update-user', [AdminController::class, 'updateUser_get'])->name('update-user-get');
    Route::post('/update-user', [AdminController::class, 'updateUser_post'])->name('update-user-post');

    /*product*/
    Route::get('/product', [ProductController::class, 'index'])->name('product_home');
    Route::get('/product/add-product', [ProductController::class, 'addPro_get'])->name('add-product-get');
    Route::post('/product/add-product', [ProductController::class, 'addPro_post'])->name('add-product-post');
    Route::get('/product/delete', [ProductController::class, 'deletePro'])->name('delete-product');
    Route::get('/product/lst-product-detail', [ProductController::class, 'lstPro_detail'])->name('lst-product-detail');
    Route::get('/product/add-product-detail', [ProductController::class, 'addPro_detail_get'])->name('add-product-detail-get');
    Route::get('/product/update-product-detail', [ProductController::class, 'updatePro_detail_get'])->name('update-product-detail-get');
    Route::post('/product/update-product-detail', [ProductController::class, 'updatePro_detail_post'])->name('update-product-detail-post');
    Route::post('/product/add-product-detail', [ProductController::class, 'addPro_detail_post'])->name('add-product-detail-post');
    Route::get('/product/delete-detail-product', [ProductController::class, 'deletePro_detail'])->name('delete-product-detail');
    Route::get('/product/update-product/{id}', [ProductController::class, 'updatePro_get'])->name('update-product-get');
    Route::post('/product/update-product', [ProductController::class, 'updatePro_post'])->name('update-product-post');


    /*Slider*/
    Route::get('/slider', [SliderController::class, 'index'])->name('lst_slider');
    Route::get('/slider/add-slider', [SliderController::class, 'addSlider_get'])->name('add-slider-get');
    Route::post('/slider/add-slider', [SliderController::class, 'addSlider_post'])->name('add-slider-post');


    /*category*/
    Route::get('/category', [CategoryController::class, 'index'])->name('lst_category');
    Route::get('/category/add-category', [CategoryController::class, 'addCategory_get'])->name('add-cate-get');
    Route::post('/category/add-category', [CategoryController::class, 'addCategory_post'])->name('add-cate-post');
});

Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'loginPost'])->name('login-post');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
