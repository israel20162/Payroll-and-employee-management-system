<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
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
        Gate::define('give tasks', function ($permission) {
            $permissions = session('permissions', []);

            return in_array($permission, $permissions);

        });

        //
        Blade::if ('can', function ($permission) {

            $permissions = session('permissions', []);

            return in_array($permission, $permissions);
        });

        Blade::if ('cannnot', function ($permission) {

            $permissions = session('permissions', []);
            if (in_array($permission, $permissions)) {
                return false;
            }

            return true;

            
        });



    }
}
