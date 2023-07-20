<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

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

// route admin
Route::prefix('admin')->group(function () {
    Route::group(['middleware' => 'auth'], function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard.index');
        Route::resource('/category', CategoryController::class, ['as' => 'admin']);
        Route::resource('/product', ProductController::class, ['as' => 'admin']);
        Route::resource('/order', OrderController::class, [
            'except' => [
                'create',
                'store',
                'edit',
                'update',
                'destroy'
            ],
            'as' => 'admin'
        ]);
        Route::get('/customer', [CustomerController::class, 'index'])->name('admin.customer.index');
        Route::resource('/slider', SliderController::class, [
            'except' => [
                'show',
                'create',
                'edit',
                'update'
            ],
            'as' => 'admin'
        ]);

        Route::get('/profile', [ProfileController::class, 'index'])->name('admin.profile.index');
        Route::resource('/user', UserController::class, ['except' => ['show'], 'as' => 'admin']);
    });
});
