<?php

namespace TDAdmin\Core;

use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;

class TestServiceProvider extends ServiceProvider
{
   
    protected $key = 'test';

    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->setupConfig();
        $this->setupRoutes();
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        
    }


    protected function setupRoutes()
    {
        $this->app->router->group([
            'namespace' => $this->getRouteNamespace(),
        ], function ($router) {
            require $this->getRoutesPath();
        });
    }

    protected function setupConfig()
    {
        $this->app->configure($this->key);
        $this->mergeConfigFrom($this->getConfigPath() , $this->key);
    }

    protected function getConfigPath() : string
    {
        return __DIR__.'/../config/'.$this->key.'.php';
    }

    protected function getRoutesPath() : string
    {
        return __DIR__.'/../routes/'.$this->key.'.php';
    }

    protected function getRouteNamespace() : string
    {
        return __NAMESPACE__ . '\Controllers';
    }
}