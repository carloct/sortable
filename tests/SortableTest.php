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
        foreach (Entry::all() as $entry) {
            $this->assertEquals($entry->name, $entry->position);
        }
    }

    /**
     * @test
     */
    public function it_can_get_the_lastPosition()
    {
        $this->assertEquals(Entry::all()->count(), (new Entry())->getLastPosition());
    }

    /**
     * @test
     */
    public function it_shifts_backward_on_ordering()
    {
        $entry = Entry::where(['name' => '4'])->first();

        $entry->setPosition(1);
        $entry->save();

        $entries = Entry::whereIn('name', range(1,3))->get();

        $this->assertEquals($entry->position, '1');
        $this->assertEquals($entries[0]->position, '2');
        $this->assertEquals($entries[1]->position, '3');
        $this->assertEquals($entries[2]->position, '4');

    }

    /**
     * @test
     */
    public function it_shifts_forward_on_ordering()
    {
        $entry = Entry::where(['name' => '2'])->first();

        $entry->setPosition(5);
        $entry->save();

        $entries = Entry::whereIn('name', range(3, 5))->get();

        $this->assertEquals($entry->position, '5');
        $this->assertEquals($entries[0]->position, '2');
        $this->assertEquals($entries[1]->position, '3');
        $this->assertEquals($entries[2]->position, '4');


    }

    /**
     * @test
     */
    public function it_shifts_backward_on_ordering_last_element()
    {
        $entry = Entry::where(['name' => '2'])->first();

        $entry->setPosition(20);
        $entry->save();

        $this->assertEquals($entry->position, '20');

    }

    /**
     * @test
     */
    public function it_shifts_forward_on_ordering_first_element()
    {
        $entry = Entry::where(['name' => '18'])->first();

        $entry->setPosition(1);
        $entry->save();

        $this->assertEquals($entry->position, '1');

    }
}