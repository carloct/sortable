<?php

namespace Keisen\Sortable\Test;

use Illuminate\Database\Eloquent\Model;
use Keisen\Sortable\Sortable;
use Keisen\Sortable\SortableTrait;

class Entry extends Model implements Sortable
{
    use SortableTrait;

    protected $table = 'entries';
    protected $guarded = [];
    public $timestamps = false;

}