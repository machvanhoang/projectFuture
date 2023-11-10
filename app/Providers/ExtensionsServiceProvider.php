<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ExtensionsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        require_once app_path("/Constant/constants.php");
        require_once app_path("/Helper/helpers.php");
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
