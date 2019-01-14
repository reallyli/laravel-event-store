<?php

namespace Uniqueway\LaravelEventStore;

use Illuminate\Support\Facades\Event as LaravelEvent;
use Illuminate\Support\ServiceProvider;

class LaravelEventStoreServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../migrations');

        LaravelEvent::listen('*', function ($name, $payload) {
            $event = $payload[0];
            if (is_subclass_of($event, ShouldBeStored::class)) {
                Event::createFromEvent($event);
            }
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
