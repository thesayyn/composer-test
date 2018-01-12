<?php

namespace TDAdmin\Core;

use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;

class FractalServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->setupConfig();
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        
    }

    protected function setupConfig()
    {
        $source = realpath(__DIR__.'/../config/core.php');
        $this->app->configure('core');
        $this->mergeConfigFrom($source, 'core');
    }

}