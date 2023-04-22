<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
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


Route::get('/', [HomeController::class, 'getPage'])->name("/");
Route::post('/getlatest', [HomeController::class, 'getLatest'])->name("getLatest");
Route::get('/product/{id}', [ProductController::class, 'getPage'])->name("product");
Route::get('/products/{category}', [ProductsController::class, 'getPage'])->name("products");
Route::get('/products/{category}/sort', [ProductsController::class, 'sort'])->name("products-sort");
Route::get('/test', [AdminController::class, 'signup'])->name("test");
Route::get('/cart', [CartController::class, 'load'])->name("cart");
Route::get('/addtocart', [CartController::class, 'addToCart'])->name("addtocart");
Route::get('/delfromcart', [CartController::class, 'removeFromCart'])->name("delfromcart");
Route::get('/getcartdata', [CartController::class, 'getData'])->name("getcartdata");
Route::post('/clearcart', [CartController::class, 'clearCart'])->name("clearcart");
Route::post('/addorder', [CartController::class, 'addOrder'])->name("addOrder");
Route::get('/cartcount', [CartController::class, 'cartCount'])->name("cartcount");



    Route::group(['middleware' => ['guest']], function() {

        /**
         * Login Routes
         */
        Route::get('/adminlogin', [AdminController::class, 'getPage'])->name('login.show');
        Route::post('/adminlogin', [AdminController::class, 'login'])->name('login.perform');

    });

    Route::group(['middleware' => ['auth']], function() {
        /**
         * Logout Routes
         */
        Route::get('/logout', [AdminController::class, 'logOut'])->name('logout.perform');

        Route::get('/adminpanel',  [AdminController::class, 'load'])->name('admin-panel');
        Route::get('/getdbdata',  [AdminController::class, 'getColumns'])->name('getdbdata');
        Route::get('/adminpanel/{db}',  [AdminController::class, 'getData'])->name('getdb');
        Route::get('/updatedata',  [AdminController::class, 'getUpdateData'])->name('getUpdateData');
        Route::post('/adminaction',  [AdminController::class, 'adminAction'])->name('adminaction');
        Route::post('/filesupload',  [AdminController::class, 'uploadFiles'])->name('filesupload');

    });
