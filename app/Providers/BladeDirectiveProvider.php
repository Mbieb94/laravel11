<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeDirectiveProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Blade::directive('permission', function ($expression) {
            return "<?php if($expression > 1): ?>";
        });

        Blade::directive('endpermission', function ($expression) {
            return "<?php endif ?>";
        });
    }
}
