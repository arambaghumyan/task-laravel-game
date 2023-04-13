<?php

namespace App\Providers;

use App\Contracts\GameInterface;
use App\Contracts\TokenInterface;
use App\Repositories\GameRepository;
use App\Repositories\TokenRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            'App\Contracts\UserInterface',
            'App\Repositories\UserRepository'
        );
        $this->app->bind(
            TokenInterface::class,
            TokenRepository::class
        );

        $this->app->bind(
            GameInterface::class,
            GameRepository::class
        );

        $this->app->bind(
            'App\Contracts\Admin\UserInterface',
            'App\Repositories\Admin\UserRepository'
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
