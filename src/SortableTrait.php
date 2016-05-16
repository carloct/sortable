<?php

namespace Keisen\Sortable;

trait SortableTrait
{
    public $old_position = 0;

    public function appendToLastPosition()
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

    public function setPosition(int $position)
    {
        $this->old_position = $this->position;
        $this->position = $position;
    }

    protected function getPositionColumnName()
    {
        if (isset($this->sortable['position_column_name']) &&
            !empty($this->sortable['position_column_name'])
        ) {
            return $this->sortable['position_column_name'];
        }
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