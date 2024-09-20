<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Controllers\Admin\Auth\AdminLoginController;

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

Route::group(['middleware' => ['demo', 'XSS']], function () {

    Route::group(['middleware' => ['maintainance']], function () {

        Route::group(['middleware' => ['HtmlSpecialchars']], function () {

            Route::get('/', function (Request $request) {
                return redirect()->route('admin.login');
            });


            Route::group(['as' => 'admin.', 'prefix' => 'admin'], function () {
                Route::get('login', [AdminLoginController::class, 'adminLoginPage'])->name('login');
                Route::post('login', [AdminLoginController::class, 'storeLogin'])->name('store-login');
                Route::post('logout', [AdminLoginController::class, 'adminLogout'])->name('logout');
            });
        });
    });
});
