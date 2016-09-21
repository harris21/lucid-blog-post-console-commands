<?php

namespace App\Foundation;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    public function register()
    {
        // Register the service providers of your Services here.
        $this->app->register('App\Services\Publisher\Providers\PublisherServiceProvider');
    }
}
