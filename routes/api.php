<?php

use App\Http\Controllers\Admin\Categories\CategoriesController;
use App\Http\Controllers\Admin\Reviews\ReviewsController;
use App\Http\Controllers\Admin\UserDeposite\UserDepositeController;
use App\Http\Controllers\Admin\UserOrder\UserOrderController;
use App\Http\Controllers\Api\Ads\AdsController;
use App\Http\Controllers\Api\Category\CategoryProductController;
use App\Http\Controllers\Api\Products\ProductsController;
use App\Http\Controllers\Api\Reviews\ReviewsApiController;
use App\Http\Controllers\Api\Station\StationController;
use App\Http\Controllers\Auth\CreateAcountController;
use App\Http\Controllers\Auth\LoginAccountController;
use App\Http\Controllers\Auth\OtpController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Middleware\CheckJwtToken;
use Illuminate\Support\Facades\Route;






























Route::group(['prefix' => 'v1/app/auth'], function () {

    // Public Routes
    Route::post('register', [CreateAcountController::class, 'register']);
    Route::post('login', [LoginAccountController::class, 'login']);
    Route::post('social-login', [LoginAccountController::class, 'socialLogin']);

    Route::group(['middleware' => CheckJwtToken::class], function () {
        Route::get('me', [ProfileController::class, 'me']);
        Route::post('refresh', [LoginAccountController::class, 'refresh']);
        Route::post('logout', [ProfileController::class, 'logout']);
        Route::post('profile/update', [ProfileController::class, 'update']);   // POST بدل PUT عشان الصور (multipart)
        Route::post('profile/change-password', [ProfileController::class, 'changePassword']);
    });
    Route::post('send-otp', [OtpController::class, 'send'])
        ->defaults('context', 'register');

    Route::post('verify-otp', [OtpController::class, 'verify'])
        ->defaults('context', 'register');

    // Password Reset Flow
    Route::post('/forget-password/send-otp', [OtpController::class, 'send'])
        ->defaults('context', 'forget_password');

    Route::post('/forget-password/verify-otp', [OtpController::class, 'verify'])
        ->defaults('context', 'forget_password');
});

Route::group(['prefix' => 'v1/front'], function () {
    Route::get('categories', [CategoriesController::class, 'index']);
    Route::get('categoriesWithProduct', [CategoryProductController::class, 'index']);
    Route::get('home-sections', [ProductsController::class, 'index']);
    Route::get('products/{id}', [ProductsController::class, 'show']);
    Route::middleware(CheckJwtToken::class)->group(function () {
        Route::post('reviews', [ReviewsApiController::class, 'store']);
        Route::put('reviews/{review}', [ReviewsApiController::class, 'update']);
    });
});

require __DIR__ . '/admin.php';
