<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\CuponController;
use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Backend\ContactController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\TestimonialController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//================ Frontend all Controller =================
Route::get('/', [IndexController::class, 'index'])->name('index');
Route::get('/cart', [IndexController::class, 'cart'])->name('cart');
Route::get('/shop', [IndexController::class, 'shop'])->name('shop');
Route::get('/about-us', [IndexController::class, 'about'])->name('about');
Route::get('/contact-us', [IndexController::class, 'contact'])->name('contact');
Route::post('contact/store', [IndexController::class, 'contactStore'])->name('contact.store');
Route::get('product/{slug}', [IndexController::class, 'productDetails'])->name('product.details');
Route::get('category/{slug}', [IndexController::class, 'productCategory'])->name('product.category');





//================ Backend all Controller =================
Route::prefix('admin')->group(function() {
    Route::get('/', [AdminController::class, 'dashbaord'])->name('dashbaord');

    //========================= Category Controller
    Route::resource('category', CategoryController::class);

    //========================= Product Controller
    Route::resource('product', ProductController::class);

    //========================= Banner Controller
    Route::resource('banner', BannerController::class);
    Route::get('banner/active/{id}', [BannerController::class, 'active'])->name('banner.active');
    Route::get('banner/deactive/{id}', [BannerController::class, 'deactive'])->name('banner.deactive');

    //========================= Cupon Controller
    Route::resource('cupon', CuponController::class);
    Route::get('cupon/active/{id}', [CuponController::class, 'active'])->name('cupon.active');
    Route::get('cupon/deactive/{id}', [CuponController::class, 'deactive'])->name('cupon.deactive');

    //========================= Testimonial Controller
    Route::resource('testimonial', TestimonialController::class);

    //========================= Contact Controller
    Route::get('contact', [ContactController::class, 'index'])->name('contact.index');
    Route::get('contact/seen/{id}', [ContactController::class, 'seen'])->name('contact.seen');
    Route::get('contact/unseen/{id}', [ContactController::class, 'unseen'])->name('contact.unseen');
    Route::post('contact/delete/{id}', [ContactController::class, 'destroy'])->name('contact.destroy');
    Route::get('contact/download/{id}', [ContactController::class, 'download'])->name('contact.download');
});
