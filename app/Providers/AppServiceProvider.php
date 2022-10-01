<?php

namespace App\Providers;

use App\Models\Logo;
use App\Models\SocialMedia;
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


        view()->composer('*', function ($view) {
            $logo = Logo::first();
            $view->with('logo', $logo);
        });

        view()->composer('*', function ($view) {
            $social = SocialMedia::first();
            $view->with('social', $social);
        });
    }
}
