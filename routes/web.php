<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\FaqController;
use App\Http\Controllers\Backend\InfoController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\CuponController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Backend\ContactController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Frontend\CheckoutController;
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

//========================= Index Controller
Route::get('/', [IndexController::class, 'index'])->name('index');
Route::get('/shop', [IndexController::class, 'shop'])->name('shop');
Route::get('/about-us', [IndexController::class, 'about'])->name('about');
Route::get('/contact-us', [IndexController::class, 'contact'])->name('contact');
Route::post('contact/store', [IndexController::class, 'contactStore'])->name('contact.store');
Route::get('product/{slug}', [IndexController::class, 'productDetails'])->name('product.details');
Route::get('category/{slug}', [IndexController::class, 'productCategory'])->name('product.category');

//========================= User Controller
Route::get('profile', [UserController::class, 'profile'])->name('profile');
Route::post('profile/update/', [UserController::class, 'updateProfile'])->name('profile.update');
Route::post('password/update/', [UserController::class, 'updatePassword'])->name('password.update');

//========================= User Controller
Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::get('/{cupon_name}', [CartController::class, 'index'])->name('cart.cuponName');
    Route::post('/store', [CartController::class, 'store'])->name('cart.store');
    Route::post('/update', [CartController::class, 'update'])->name('cart.update');
    Route::get('/destroy/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
});

//========================= Checkout Controller
Route::group(['prefix' => 'checkout'], function () {
    Route::get('/', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/get/city', [CheckoutController::class, 'getCity'])->name('ajax.getCity');
    Route::post('/store', [CheckoutController::class, 'store'])->name('checkout.store');

});
Route::get('/mail/{id}', [CheckoutController::class, 'rander'])->name('checkout.rander');





//================ Backend all Controller =================
Route::prefix('admin')->group(function() {
    Route::get('/', [AdminController::class, 'dashbaord'])->name('dashbaord');

    //========================= Category Controller
    Route::resource('category', CategoryController::class);

    //========================= Product Controller
    Route::resource('product', ProductController::class);

    //========================= Testimonial Controller
    Route::resource('testimonial', TestimonialController::class);

    //========================= Testimonial Controller
    Route::resource('faq', FaqController::class);

    //========================= Banner Controller
    Route::resource('banner', BannerController::class);
    Route::get('banner/active/{id}', [BannerController::class, 'active'])->name('banner.active');
    Route::get('banner/deactive/{id}', [BannerController::class, 'deactive'])->name('banner.deactive');

    //========================= Cupon Controller
    Route::resource('cupon', CuponController::class);
    Route::get('cupon/active/{id}', [CuponController::class, 'active'])->name('cupon.active');
    Route::get('cupon/deactive/{id}', [CuponController::class, 'deactive'])->name('cupon.deactive');

    //========================= Contact Controller
    Route::get('contact', [ContactController::class, 'index'])->name('contact.index');
    Route::get('contact/seen/{id}', [ContactController::class, 'seen'])->name('contact.seen');
    Route::get('contact/unseen/{id}', [ContactController::class, 'unseen'])->name('contact.unseen');
    Route::post('contact/delete/{id}', [ContactController::class, 'destroy'])->name('contact.destroy');
    Route::get('contact/download/{id}', [ContactController::class, 'download'])->name('contact.download');

    //========================= Order Controller
    Route::resource('order', OrderController::class);
    Route::get('order/accept/{id}', [OrderController::class, 'accept'])->name('order.accept');
    Route::get('order/reject/{id}', [OrderController::class, 'reject'])->name('order.reject');
    Route::get('accept/list', [OrderController::class, 'orderAccept'])->name('order.orderAccept');
    Route::get('pending/list', [OrderController::class, 'orderPending'])->name('order.orderPending');
    Route::get('invoice/{id}', [OrderController::class, 'invoice'])->name('invoice.show');
    Route::get('invoice/download/{id}', [OrderController::class, 'invoiceDownload'])->name('invoice.download');

    //========================= Info Controller
    Route::resource('info', InfoController::class);

});
