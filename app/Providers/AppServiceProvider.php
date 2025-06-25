<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Whoops\Run;
use Whoops\Handler\PrettyPageHandler;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if (app()->environment('local')) {
        $whoops = new Run;
        $whoops->pushHandler(new PrettyPageHandler);
        $whoops->register();
    }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
