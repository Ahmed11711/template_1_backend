<?php

namespace App\Providers;


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
