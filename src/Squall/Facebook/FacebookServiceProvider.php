<?php

namespace Squall\Facebook;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;

class FacebookServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot() {
        $this->package('squall/facebook');
        AliasLoader::getInstance()->alias('FB', 'Squall\Facebook\FB');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {
        $this->app['facebook'] = $this->app->share(function ($app) {
            return new FB();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides() {
        return array('facebook');
    }

}
