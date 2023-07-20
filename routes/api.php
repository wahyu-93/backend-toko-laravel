<?php

namespace App\Http\Controllers\Api;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/register', [AuthController::class, 'register'])->name('api.customer.register');
Route::post('/login', [AuthController::class, 'login'])->name('api.customer.login');
Route::get('/user', [AuthController::class, 'getUser'])->name('api.customer.user');

Route::get('/order', [OrderController::class, 'index'])->name('api.order.index');
Route::get('/order/{snap_token}', [OrderController::class, 'show'])->name('api.order.show');

Route::get('/categories', [CategoryController::class, 'index'])->name('api.category.index');
Route::get('/category/{slug?}', [CategoryController::class, 'show'])->name('api.category.show');
Route::get('/categoryHeader', [CategoryController::class, 'categoryHeader'])->name('api.category.categoryHeader');

Route::get('/product', [ProductController::class, 'index'])->name('api.product.index');
Route::get('/product/{slug?}', [ProductController::class, 'show'])->name('api.product.show');

Route::get('/cart', [CartController::class, 'index'])->name('api.cart.index');
Route::post('/cart', [CartController::class, 'store'])->name('api.cart.store');
Route::get('/cart/total', [CartController::class, 'getCartTotal'])->name('api.cart.total');
Route::get('/cart/totalWeight', [CartController::class, 'getCartTotalWeight'])->name('api.cart.getCartTotalWeight');
Route::post('/cart/remove', [CartController::class, 'removeCart'])->name('api.cart.remove');
Route::post('/cart/removeAll', [CartController::class, 'removeAllCart'])->name('api.cart.removeAll');

Route::get('/rajaongkir/provinces', [RajaOngkirControler::class, 'getProvinces'])->name('customer.rajaongkir.getProvinces');
Route::get('/rajaongkir/cities', [RajaOngkirControler::class, 'getCities'])->name('customer.rajaongkir.getCities');
Route::post('/rajaongkir/checkOngkir', [RajaOngkirControler::class, 'checkOngkir'])->name('customer.rajaongkir.chekcOngkir');

Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
Route::post('/notificationHandler', [CheckoutController::class, 'notificatioHandler'])->name('notificationhandler');

Route::get('/sliders', [SliderController::class, 'index'])->name('customer.slider.index');
