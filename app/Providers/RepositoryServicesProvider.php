<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\User\UserRepositoryInterface;
use  App\Repositories\User\UserRepository;
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
