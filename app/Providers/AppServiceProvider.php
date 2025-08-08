<?php

namespace App\Providers;

use App\SocialiteProviders\SiaptubaProvider;
use Illuminate\Support\ServiceProvider;
use Laravel\Socialite\Facades\Socialite;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Socialite::extend('siaptuba', function ($app) {
            $config = $app['config']['services.siaptuba'];
            return Socialite::buildProvider(SiaptubaProvider::class, $config);
        });
    }
}
