<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\CuponController;
use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\CategoryController;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->group(function() {
    Route::get('/', [AdminController::class, 'dashbaord'])->name('dashbaord');

    //========================= Category Controller
    Route::resource('category', CategoryController::class);

    //========================= Product Controller
    Route::resource('product', ProductController::class);

    //========================= Banner Controller
    Route::resource('banner', BannerController::class);

    //========================= Cupon Controller
    Route::resource('cupon', CuponController::class);
});