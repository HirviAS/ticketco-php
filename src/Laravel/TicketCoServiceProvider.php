<?php

namespace TicketCo\Laravel;

use Illuminate\Support\ServiceProvider;
use TicketCo\Client;

class TicketCoServiceProvider extends ServiceProvider
{

    /**
     * Register paths to be published by the publish command.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/ticketco.php' => config_path('ticketco.php')
        ]);
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('TicketCo\Client', function ($app, $args) {
            $config = $app['config']['ticketco'];

            $apikey = isset($args[0]) ? $args[0] : $config['apikey'];
            $clientOptions = isset($args[1]) ? $args[1] : [];

            return new Client($apikey, $clientOptions);
        });
    }
}