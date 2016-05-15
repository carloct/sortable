<?php

namespace Keisen\Sortable\Test;

use Illuminate\Support\Collection;

class SortableTest extends TestCase
{
    /**
     * @test
     */
    public function it_sets_the_position_column_on_creation()
    {
        foreach(Entry::all() as $entry) {
            $this->assertEquals($entry->name, $entry->position);
        }
    }
}