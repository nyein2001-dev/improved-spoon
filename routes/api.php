<?php

use App\Http\Controllers\Api\HomeController;
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

    Route::post('/newsletter-request', [HomeController::class, 'newsletter_request'])->name('newsletter-request');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
