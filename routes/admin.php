<?php

use App\Http\Controllers\Admin\Ads\AdsController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Driver\DriverController;
use App\Http\Controllers\Admin\Driver\MyDrvierController;
use App\Http\Controllers\Admin\Governorate\GovernorateController;
use App\Http\Controllers\Admin\Order\OrderController;
use App\Http\Controllers\Admin\Station\StationController;
use App\Http\Controllers\Admin\User\UserController;
use App\Http\Controllers\Admin\UserDepoiteAdmin\UserDepositeAdminController;
use App\Http\Controllers\Admin\UserDeposite\UserDepositeController;
use App\Http\Controllers\Admin\UserOrder\UserOrderController;
use App\Http\Controllers\Driver\DriverWalletController;
use App\Http\Controllers\Driver\LogDriverController;
use App\Http\Middleware\CheckJwtToken;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ShippingGovernorateBranch\ShippingGovernorateBranchController;
use App\Http\Controllers\Admin\ShippingGovernorate\ShippingGovernorateController;
use App\Http\Controllers\Admin\ShippingMethod\ShippingMethodController;
use App\Http\Controllers\Admin\Coupon\CouponController;
use App\Http\Controllers\Admin\PaymentGateway\PaymentGatewayController;

use App\Http\Controllers\Admin\Section\SectionController;
use App\Http\Controllers\Admin\Pages\PagesController;
use App\Http\Controllers\Admin\Reviews\ReviewsController;
use App\Http\Controllers\Admin\setting\settingController;
use App\Http\Controllers\Admin\HomeSection\HomeSectionController;
use App\Http\Controllers\Admin\Products\ProductsController;
use App\Http\Controllers\Admin\Categories\CategoriesController;






Route::prefix('v1/admin')->group(function () {
    Route::post('login', [LoginController::class, 'login']);
    Route::get('me', [LoginController::class, 'me'])->middleware(CheckJwtToken::class);
});

Route::prefix('v1')->group(function () {
    Route::apiResource('users', UserController::class)->names('user');
    Route::apiResource('categories', CategoriesController::class)->names('categories');
    Route::apiResource('products', ProductsController::class)->names('products');
    Route::apiResource('home_sections', HomeSectionController::class)->names('home_section');
    Route::apiResource('settings', settingController::class)->names('setting');
    Route::apiResource('reviews', ReviewsController::class)->names('reviews');
    Route::apiResource('pages', PagesController::class)->names('pages');
    Route::apiResource('sections', SectionController::class)->names('section')->except(['store', 'update', 'get']);
    Route::get('sections', [SectionController::class, 'byPage']);
    Route::get('sectionss', [SectionController::class, 'index']);
    Route::post('sections', [SectionController::class, 'bulkStore'])->name('section.store');
    Route::apiResource('payment_gateways', PaymentGatewayController::class)->names('payment_gateway');
    Route::apiResource('coupons', CouponController::class)->names('coupon');
    Route::apiResource('shipping_methods', ShippingMethodController::class)->names('shipping_method');
    Route::apiResource('shipping_governorates', ShippingGovernorateController::class)->names('shipping_governorate');
    Route::apiResource('shipping_governorate_branches', ShippingGovernorateBranchController::class)->names('shipping_governorate_branch');
});
