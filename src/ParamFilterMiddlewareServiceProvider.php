<?php

namespace ParamFilter;

use Illuminate\Support\ServiceProvider;

class ParamFilterMiddlewareServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app['router']->aliasMiddleware('slsec', ParamFilterMiddleware::class);
    }

    public function register()
    {
        // ...
    }
}
