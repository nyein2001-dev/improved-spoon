<?php

use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\User\CartController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\LoginController;
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

Route::group(['middleware' => ['demo', 'XSS', 'HtmlSpecialchars']], function () {

    Route::get('/website-setup', [HomeController::class, 'website_setup'])->name('website-setup');

    Route::group(['middleware' => ['maintainance']], function () {

        Route::get('/', [HomeController::class, 'index'])->name('home');

        Route::prefix('user')->group(function () {
            Route::get('/cart-items', [CartController::class, 'cart_items'])->name('cart-items');
        });

        Route::post('/newsletter-request', [HomeController::class, 'newsletter_request'])->name('newsletter-request');

        Route::post('/store-login', [LoginController::class, 'store_login'])->name('store-login');
        Route::post('/store-register', [RegisterController::class, 'store_register'])->name('store-register');
    });
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
