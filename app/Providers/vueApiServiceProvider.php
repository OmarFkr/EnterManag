<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class vueApiServiceProvider extends ServiceProvider
{
    protected $commands = [
        'App\Console\Commands\generate'
    ];
    
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
    
    $this->mergeConfigFrom(
        __DIR__ . '/config/vueApi.php', 'vueApi'
    );
    
        $this->commands($this->commands);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        
        $this->loadViewsFrom(__DIR__.'/templates', 'vueApi');
        
        $this->publishes([
            __DIR__ . '/config/vueApi.php' => config_path('vueApi.php'),
        ], 'config');
        
    
        
        $this->publishes([
        __DIR__.'/templates' => resource_path('views/vendor/vueApi'),
        ],'templates');
        
    }
}
