<?php

namespace Keisen\Sortable;

interface Sortable
{
    /*
     * Set the last order value
     */
    public function setLastPosition();

    public function scopeOrdered(\Illuminate\Database\Eloquent\Builder $query);

    public function setPosition($position);

    public function shouldSortWhenCreating();
}
