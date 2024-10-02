<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Auth\AdminForgotPasswordController;
use App\Http\Controllers\Admin\AdminProfileController;

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


            // start admin routes
            Route::group(['as' => 'admin.', 'prefix' => 'admin'], function () {

                // start auth route
                Route::get('login', [AdminLoginController::class, 'adminLoginPage'])->name('login');
                Route::post('login', [AdminLoginController::class, 'storeLogin'])->name('store-login');
                Route::post('logout', [AdminLoginController::class, 'adminLogout'])->name('logout');
                Route::get('forget-password', [AdminForgotPasswordController::class, 'forgetPassword'])->name('forget-password');

                Route::get('profile', [AdminProfileController::class, 'index'])->name('profile');

                Route::get('/', [DashboardController::class, 'dashboard']);
                Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
            });
        });
    });
});
