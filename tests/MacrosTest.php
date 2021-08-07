<?php

namespace Teofanis\LaravelUtils\Tests;

class MacrosTest extends TestCase
{
    /** @test */
    public function test_collection_to_assoc_macro()
    {
        $collection = collect(['test', 'one', 'two']);
        $this->assertEquals(
            $collection,
            collect([
            0 => 'test',
            1 => 'one',
            2 => 'two',
            ])
        );
        $collection = $collection->toAssoc();
        $this->assertEquals(
            $collection,
            collect([
            'test' => 'test',
            'one' => 'one',
            'two' => 'two',
            ])
        );
    }
}
