<?php

namespace App\Providers;

use App\Repositories\BlogRepositoryInterface;
use App\Repositories\Implement\BlogRepository;
use App\Repositories\Implement\UserRepository;
use App\Repositories\UserRepositoryInterface;
use App\Services\BlogServiceInterface;
use App\Services\Implement\BlogService;
use App\Services\Implement\Test;
use App\Services\Implement\TestInterface;
use App\Services\Implement\UserService;
use App\Services\UserServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Repositories
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(BlogRepositoryInterface::class, BlogRepository::class);

        // Services
        $this->app->bind(UserServiceInterface::class, UserService::class);

        $this->app->bind(BlogServiceInterface::class, BlogService::class);
        $this->app->bind(TestInterface::class, Test::class);

    }
}
