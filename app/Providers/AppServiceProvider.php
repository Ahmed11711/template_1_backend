<?php

namespace App\Providers;

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
