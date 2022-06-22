<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\PlantsController;
use App\Http\Controllers\ReviewsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BasketController;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/catalog', [HomeController::class, 'catalog'])->name('catalog');
Route::get('/catalog/search', [HomeController::class, 'search'])->name('search');
Route::post('/catalog/check', [HomeController::class, 'review_check']);
Route::resource('category', CategoriesController::class);
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/orders', [HomeController::class, 'orders'])->name('orders');
Route::post('/orders/cancel', [HomeController::class, 'cancel_order'])->name('cancel_order');
Route::get('/price', [HomeController::class, 'price'])->name('price');


Route::get('/basket',[BasketController::class,'index'])->name('basket.index');
Route::post('/basket/add/{id}', [BasketController::class,'add'])->name('basket.add');
Route::post('/basket/index',[BasketController::class,'OrderProduct'])->name('OrderProduct');

Route::patch('/basket/index', [BasketController::class, 'MinusProductBasket']) -> name('MinusProductBasket');
Route::put('/basket/index', [BasketController::class, 'PlusProductBasket']) -> name('PlusProductBasket');
Route::delete('/basket/index', [BasketController::class, 'deleteProductBasket']) -> name('deleteProductBasket');


Route::middleware('is_admin')->prefix('admin')->group(function(){    
    Route::get('home', [HomeController::class, 'adminHome']) -> name('admin.home');
    Route::resource('plants', PlantsController::class);
    Route::resource('categories', CategoriesController::class);
    Route::resource('reviews', ReviewsController::class);
    Route::delete('reviews', [ReviewsController::class, 'destroy']) -> name('reviews.destroy');
    Route::post('reviews/check', [ReviewsController::class, 'review_check']);
    Route::get('orders', [HomeController::class, 'admin_orders']) -> name('admin.orders');
    Route::post('order/edit', [HomeController::class, 'order_edit']) -> name('admin.order.edit');
});
