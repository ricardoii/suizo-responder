<?php

namespace Ricardo\ApiSuizoService\Providers;

use Illuminate\Support\ServiceProvider;
use Ricardo\ApiSuizoService\ApiSuizoService;

class ApiSuizoServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('apisuizo', function () {
            return new ApiSuizoService();
        });
    }

    public function boot()
    {
        //
    }
}
