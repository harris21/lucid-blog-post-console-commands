<?php
namespace App\Services\Publisher\Providers;

use View;
use Lang;
use Illuminate\Support\ServiceProvider;
use App\Services\Publisher\Providers\RouteServiceProvider;
use Illuminate\Translation\TranslationServiceProvider;

class PublisherServiceProvider extends ServiceProvider
{
    /**
    * Register the Publisher service provider.
    *
    * @return void
    */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);

        $this->registerResources();
    }

    /**
     * Register the Publisher service resource namespaces.
     *
     * @return void
     */
    protected function registerResources()
    {
        // Translation must be registered ahead of adding lang namespaces
        $this->app->register(TranslationServiceProvider::class);

        Lang::addNamespace('publisher', realpath(__DIR__.'/../resources/lang'));

        View::addNamespace('publisher', base_path('resources/views/vendor/publisher'));
        View::addNamespace('publisher', realpath(__DIR__.'/../resources/views'));
    }
}
