<?php

namespace Keisen\Sortable;

trait SortableTrait
{
    public function setLastPosition()
    {
        $orderColumnName = $this->getPositionColumnName();
        $this->$orderColumnName = $this->getLastPosition() + 1;
    }

    public function getLastPosition()
    {
        return (int) static::max($this->getPositionColumnName());
    }

    public function scopeOrdered(\Illuminate\Database\Eloquent\Builder $query, $direction = 'asc')
    {
        return $query->orderBy($this->getPositionColumnName(), $direction);
    }

    public function setPosition($position)
    {
        $this->position = $position;
    }

    protected function getPositionColumnName()
    {
        return 'position';
    }

    public function shouldSortWhenCreating()
    {
        if (!isset($this->sortable)) {
            return true;
        }

        if (!isset($this->sortable['sort_when_creating'])) {
            return true;
        }

        return $this->sortable['sort_when_creating'];
    }
}