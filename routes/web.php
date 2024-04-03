<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Backend\AuthController as BackendAuthController;
use App\Http\Controllers\backend\BannerController as BackendBannerController;
use App\Http\Controllers\backend\CategoriesController as BackendCategoriesController;
use App\Http\Controllers\backend\OrderController as BackendOrderController;
use App\Http\Controllers\backend\PaymentController;
use App\Helper\Cart as HelperCart;
use App\Http\Controllers\backend\ProductsController;
use App\Http\Controllers\backend\SaleController;
use App\Http\Controllers\backend\UserController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\frontend\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PDFController;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

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
// FRONT-END
Route::get('/', function (HelperCart $cart) {
    $banners = Banner::All();
    $categories = Category::All();
    $products = Product::All();
    $categories = Category::All();
    return view('frontend.pages.home',compact('banners','categories','products','cart'));
});
Route::get('/shop', function (HelperCart $cart) {
    $page = 'Shop';
    $categories = Category::All();
    $products = Product::All();
    return view('frontend.pages.shop', compact('page','categories','products','cart'));
});
Route::get('/productdetail/{id}', function (string $id,HelperCart $cart) {
    $page = 'Shop Detail';
    $categories = Category::All();
    $product = Product::find($id);
    return view('frontend.pages.detail', compact('page','categories','product','cart'));
});
Route::get('/testimonial', function (HelperCart $cart) {
    $page = 'Testimonial';
    return view('frontend.pages.testimonial', compact('page','cart'));
});
Route::get('/contact', function (HelperCart $cart) {
    $page = 'Contact';
    return view('frontend.pages.contact', compact('page','cart'));
});
// Route::get('/cart', function () {
//     $page = 'Cart';
//     return view('frontend.pages.cart', compact('page'));
// });

//

//Cart
Route::get('/cart', [CartController::class, 'index']);
Route::post('/add-cart', [CartController::class, 'add']);
Route::post('/delete-item', [CartController::class, 'delete']);
Route::post('/discount', [CartController::class, 'discount']);
Route::get('/chackout', [CartController::class, 'chackout']);
Route::post('/checkout', [CartController::class, 'order']);



//Login
Route::get('/signin', [BackendAuthController::class, 'index'])->middleware('login');
Route::post('/login', [BackendAuthController::class, 'login'])->middleware('login');
Route::get('/logout', [BackendAuthController::class, 'logout']);

//Signup
Route::get('/signup', [BackendAuthController::class, 'signup']);
Route::post('/signupp', [BackendAuthController::class, 'signupp']);

// Admin
Route::get('/admin', function () {
    return view('backend.dashboard.layout');
})->middleware('authen');
//categories
Route::resource('/category', BackendCategoriesController::class)->middleware('authen');
//products
Route::resource('/product', ProductsController::class)->middleware('authen');
//banners
Route::resource('/banner', BackendBannerController::class)->middleware('authen');
//orders
Route::resource('/order', BackendOrderController::class)->middleware('authen');
//sales
Route::resource('/sale', SaleController::class)->middleware('authen');
//payments
Route::resource('/payment', PaymentController::class)->middleware('authen');
//users
Route::resource('/user', UserController::class)->middleware('admin');
//print PDF
Route::get('/generate-pdf/{id}', [PDFController::class,'generatePDF']);

