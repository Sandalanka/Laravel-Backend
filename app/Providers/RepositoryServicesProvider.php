<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\User\UserRepositoryInterface;
use  App\Repositories\User\UserRepository;
use App\Interfaces\Products\ProductRepositoryInterface;
use  App\Repositories\Products\ProductRepository;
class RepositoryServicesProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepositoryInterface::class,UserRepository::class);
        $this->app->bind(ProductRepositoryInterface::class,ProductRepository::class);

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
