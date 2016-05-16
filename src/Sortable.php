<?php

namespace Keisen\Sortable;

interface Sortable
{
    /*
     * Set the last order value
     */
    public function appendToLastPosition();

    public function scopeOrdered(\Illuminate\Database\Eloquent\Builder $query);

    public function setPosition(int $position);

    public function shouldSortWhenCreating();
}
