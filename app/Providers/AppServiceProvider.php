<?php

namespace App\Providers;

use App\Repositories\ShippingGovernorateBranch\ShippingGovernorateBranchRepositoryInterface;
use App\Repositories\ShippingGovernorateBranch\ShippingGovernorateBranchRepository;

use App\Repositories\ShippingGovernorate\ShippingGovernorateRepositoryInterface;
use App\Repositories\ShippingGovernorate\ShippingGovernorateRepository;

use App\Repositories\ShippingMethod\ShippingMethodRepositoryInterface;
use App\Repositories\ShippingMethod\ShippingMethodRepository;

use App\Repositories\Coupon\CouponRepositoryInterface;
use App\Repositories\Coupon\CouponRepository;

use App\Repositories\PaymentGateway\PaymentGatewayRepositoryInterface;
use App\Repositories\PaymentGateway\PaymentGatewayRepository;


use App\Repositories\Section\SectionRepositoryInterface;
use App\Repositories\Section\SectionRepository;

use App\Repositories\Pages\PagesRepositoryInterface;
use App\Repositories\Pages\PagesRepository;

use App\Repositories\Reviews\ReviewsRepositoryInterface;
use App\Repositories\Reviews\ReviewsRepository;

use App\Repositories\setting\settingRepositoryInterface;
use App\Repositories\setting\settingRepository;

use App\Repositories\HomeSection\HomeSectionRepositoryInterface;
use App\Repositories\HomeSection\HomeSectionRepository;

use App\Repositories\Products\ProductsRepositoryInterface;
use App\Repositories\Products\ProductsRepository;

use App\Repositories\Categories\CategoriesRepositoryInterface;
use App\Repositories\Categories\CategoriesRepository;

use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\User\UserRepository;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void {
$this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(CategoriesRepositoryInterface::class, CategoriesRepository::class);
        $this->app->bind(ProductsRepositoryInterface::class, ProductsRepository::class);
        $this->app->bind(HomeSectionRepositoryInterface::class, HomeSectionRepository::class);
        $this->app->bind(settingRepositoryInterface::class, settingRepository::class);
        $this->app->bind(ReviewsRepositoryInterface::class, ReviewsRepository::class);
        $this->app->bind(PagesRepositoryInterface::class, PagesRepository::class);
        $this->app->bind(SectionRepositoryInterface::class, SectionRepository::class);
        $this->app->bind(PaymentGatewayRepositoryInterface::class, PaymentGatewayRepository::class);
        $this->app->bind(CouponRepositoryInterface::class, CouponRepository::class);
        $this->app->bind(ShippingMethodRepositoryInterface::class, ShippingMethodRepository::class);
        $this->app->bind(ShippingGovernorateRepositoryInterface::class, ShippingGovernorateRepository::class);
        $this->app->bind(ShippingGovernorateBranchRepositoryInterface::class, ShippingGovernorateBranchRepository::class);
}

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::unguard();
        Validator::extend('display_field', function ($attribute, $value, $parameters, $validator) {
            return true;
        });
    }
}
