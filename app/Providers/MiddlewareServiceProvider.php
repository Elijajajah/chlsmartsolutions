<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;

class MiddlewareServiceProvider extends ServiceProvider
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
    public function boot(Router $router)
    {
        $aliases = config('middleware.aliases', []);

        foreach ($aliases as $key => $class) {
            $router->aliasMiddleware($key, $class);
        }
    }
}
