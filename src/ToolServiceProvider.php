<?php

namespace Sloveniangooner\NovaPager;

use Laravel\Nova\Nova;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Sloveniangooner\NovaPager\Http\Middleware\Authorize;
use Sloveniangooner\NovaPager\Nova\Page;
use Sloveniangooner\NovaPager\Nova\Region;
use Sloveniangooner\NovaPager\Commands\CreateTemplate;

class ToolServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'nova-pager');

        $this->publishes([
            __DIR__ . '/../database/migrations' => database_path('migrations'),
        ], 'migrations');

        $this->publishes([
            __DIR__ . '/../config/nova-pager.php' => config_path('nova-pager.php'),
        ], 'config');

        $this->app->booted(function () {
            $this->routes();
        });

        include_once __DIR__."/helpers.php";

        $pageResource = config('nova-pager.page_resource') ?: Page::class;
        $regionResource = config('nova-pager.region_resource') ?: Region::class;

        Nova::resources([
            $pageResource,
            $regionResource,
        ]);

        if ($this->app->runningInConsole()) {
            $this->commands([
                CreateTemplate::class
            ]);
        }
    }

    /**
     * Register the tool's routes.
     *
     * @return void
     */
    protected function routes()
    {
        if ($this->app->routesAreCached()) {
            return;
        }

        Route::middleware(['nova', Authorize::class])
                ->prefix('nova-vendor/nova-pager')
                ->group(__DIR__.'/../routes/api.php');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
