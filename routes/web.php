<?php

use App\Http\Controllers\AddToCartController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\frontend\HomeController as FrontendHomeController;
use App\Http\Controllers\frontend\ProductController as FrontendProductController;
use App\Http\Controllers\HeroBannerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SearchController;
use App\Models\Product;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/




Route::get('/',[FrontendHomeController::class,'home'])->name('home');

Route::get('/product',[FrontendProductController::class,'product'])->name('product');
Route::get('/product-details/{id}',[FrontendProductController::class,'productDetails'])->name('product.details');

Route::get('/blog',[BlogController::class,'blog'])->name('blog');
Route::post('/comment-store',[CommentController::class,'commentStore'])->name('commentStore');

Route::get('/category/{id}',[FrontendHomeController::class,'categoryWiseProduct'])->name('category.wize.products');

Route::get('/contact',[ContactController::class,'contact'])->name('contact');
Route::post('/contact-form',[ContactController::class,'contactForm'])->name('contact.form.store');

Route::get('/login-frontend', [LoginController::class, 'showLoginFormFrontend'])->name('login.frontend');

Route::get('/search',[SearchController::class,'search'])->name('user.search');

//AddToCard
Route::get('add-to-cart/{id}',[AddToCartController::class,'addToCart'])->name('add.to.cart');
Route::get('/view-cart',[AddToCartController::class,'viewCart'])->name('cart.view');
Route::get('/clear-cart',[AddToCartController::class,'clearCart'])->name('cart.clear');
Route::get('/cart-item/delete/{id}',[AddToCartController::class,'cartItemDelete'])->name('cart.item.delete');

//Wishlist
// Route::get('/wishlist', [WishlistController::class, 'wishlist'])->name('wishlist.index');
// Route::post('/wishlist', [WishlistController::class, 'addToWishlist'])->name('wishlist.add');
// Route::delete('/wishlist/{id}', [WishlistController::class, 'removeFromWishlist'])->name('wishlist.remove');

//Backend

//Login
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'loginProcess'])->name('login.submit');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('registration', [LoginController::class, 'registration'])->name('registration');
Route::post('registration', [LoginController::class, 'registrationStore'])->name('registration.submit');

//Middleware for check valid user
Route::group(['middleware' => 'customerAuth'], function () {
    //Cart Product Order
    Route::get('/product-checkout/{id}',[FrontendProductController::class,'productCheckout'])->name('product.checkout');

    //Sigle Product Order
    Route::get('/product-checkout-single/product/{id}',[FrontendProductController::class,'singleProductCheckout'])->name('single.product.checkout');

    //Order Create for both
    Route::post('/product-order/{id}',[FrontendProductController::class,'order'])->name('product.order.store');

});

//middleware auth and admin
Route::group(['middleware' => 'auth','admin','prefix'=>'admin'], function () {

Route::get('/',[HomeController::class,'dashboard'])->name('dashboard');
Route::get('/category-form',[CategoryController::class,'categoryForm'])->name('category.form');
Route::post('/category-store',[CategoryController::class,'categoryStore'])->name('category.store');
Route::get('/category-list',[CategoryController::class,'categoryList'])->name('category.list');
Route::get('/category-edit/{id}',[CategoryController::class,'categoryedit'])->name('category.edit');
Route::post('/category-update/{id}',[CategoryController::class,'categorupdate'])->name('category.update');
Route::get('/category-delete/{id}',[CategoryController::class,'categordelete'])->name('category.delete');

Route::get('/product-form',[ProductController::class,'productForm'])->name('product.form');
Route::post('/product-store',[ProductController::class,'productStore'])->name('product.store');
Route::get('/product-list',[ProductController::class,'productList'])->name('product.list');
Route::get('/product-edit/{id}',[ProductController::class,'productEdit'])->name('product.edit');
Route::post('/product-update/{id}',[ProductController::class,'productupdate'])->name('product.update');
Route::get('/product-delete/{id}',[ProductController::class,'productDelete'])->name('product.delete');

Route::get('/new-arrival-product-form',[ProductController::class,'NewArrivalproductForm'])->name('new.arrival.product.form');
Route::get('/new-arrival-product-list',[ProductController::class,'NewArrivalproductList'])->name('new.arrival.product.list');
Route::post('/new-product-store',[ProductController::class,'newProductStore'])->name('new.product.store');


Route::get('/bannder-form',[BannerController::class,'bannerForm'])->name('banner.form');
Route::post('/bannder-store',[BannerController::class,'bannerStore'])->name('banner.store');
Route::get('/bannder-list',[BannerController::class,'bannerlist'])->name('banner.list');
Route::post('/bannder-update/{id}',[BannerController::class,'bannerupdate'])->name('banner.update');
Route::get('/bannder-delete/{id}',[BannerController::class,'bannerdelete'])->name('banner.delete');
Route::get('/bannder-edit/{id}',[BannerController::class,'banneredit'])->name('banner.edit');


Route::get('/blog-form',[BlogController::class,'blogPost'])->name('blog.post');
Route::post('/blog-store',[BlogController::class,'blogStore'])->name('blog.store');
Route::get('/blog-list',[BlogController::class,'bloglist'])->name('blog.list');
Route::get('/blog-delete/{id}',[BlogController::class,'blogdelete'])->name('blog.delete');

Route::get('/hero-form',[HeroBannerController::class,'heroPost'])->name('hero.post');
Route::post('/hero-store',[HeroBannerController::class,'herostore'])->name('hero.store');
Route::get('/hero-list',[HeroBannerController::class,'herolist'])->name('hero.list');
Route::get('/hero-delete/{id}',[HeroBannerController::class,'herodelete'])->name('hero.delete');

Route::get('/order-list',[OrderController::class,'orderList'])->name('order.list');
Route::get('/order-invoice/{id}',[OrderController::class,'orderinvoice'])->name('order.invoice');

Route::get('/report',[ReportController::class,'report'])->name('report');
Route::get('/report/search',[ReportController::class,'reportSearch'])->name('order.report.search');

Route::get('/contact-list',[ContactController::class,'contactlist'])->name('contact.list');
Route::get('/contact-view/{id}',[ContactController::class,'contactview'])->name('contact.view');


});
