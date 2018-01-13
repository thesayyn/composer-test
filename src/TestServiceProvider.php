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
        $this->loadMigrationsFrom( $this->getMigrationsPath() );
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        
    }

    private function publishMigrations()
    {
        $path = $this->getMigrationsPath();
        $this->publishes([$path => database_path('migrations')], 'migrations');
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

    protected function getMigrationsPath()
    {
        return __DIR__.'/../database/migrations/';
    }

    protected function getRouteNamespace() : string
    {
        return __NAMESPACE__ . '\Http';
    }
}