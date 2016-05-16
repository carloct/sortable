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
                $model->appendToLastPosition();
            }
        });

        $this->app['events']->listen('eloquent.updating*', function ($model) {
            if ($model instanceof Sortable && $model->position < $model->old_position) {
                $model
                    ->whereIn('position', range($model->position, $model->old_position - 1))
                    ->increment('position');
            }

            if ($model instanceof Sortable && $model->position > $model->old_position) {
                $model
                    ->whereIn('position', range($model->old_position + 1, $model->position))
                    ->decrement('position');
            }
        });
    }
    
}