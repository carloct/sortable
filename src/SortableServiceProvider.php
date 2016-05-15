<?php

namespace Keisen\Sortable;

use Illuminate\Support\ServiceProvider;

class SortableServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     */
    public function register()
    {
    }

    /**
     * The boot method.
     */
    public function boot()
    {
        $this->app['events']->listen('eloquent.creating*', function ($model) {
            if ($model instanceof Sortable && $model->shouldSortWhenCreating()) {
                $model->setLastPosition();
            }
        });
    }
    
}