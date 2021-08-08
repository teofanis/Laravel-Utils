<?php

namespace Teofanis\LaravelUtils\Tests;

use Teofanis\LaravelUtils\Objects\ArraySafe;

class ArraySafeTest extends TestCase
{
    /** @test */
    public function test_it_has_a_class_alias()
    {
        $this->assertTrue(array_safe() instanceof ArraySafe);
    }

    /** @test */
    public function test_it_has_a_default_return_value_for_non_existent_offsets()
    {
        $assocArray = new ArraySafe(['one' => '1', 'two' => '2', 'three' => 3]);
        $this->assertTrue($assocArray->something === null);
        $assocArray = new ArraySafe(['one' => '1', 'two' => '2', 'three' => 3], "not found");
        $this->assertTrue($assocArray->something === "not found");
    }

    /** @test */
    public function test_it_can_be_treated_as_an_array()
    {
        $normalArray = new ArraySafe(['1', '2', '3']);
        $this->assertTrue($normalArray[0] === '1');
        $assocArray = new ArraySafe(['one' => '1', 'two' => '2', 'three' => 3]);
        $this->assertTrue($assocArray['two'] === '2');
    }

    /** @test */
    public function test_it_can_be_treated_as_an_object()
    {
        $assocArray = new ArraySafe(['one' => '1', 'two' => '2', 'three' => 3]);
        $this->assertTrue($assocArray->two === '2');
    }

    /** @test */
    public function test_it_can_be_treated_as_a_laravel_collection()
    {
        $assocArray = new ArraySafe(['one' => '1', 'two' => '2', 'three' => 3]);
        $result = $assocArray->filter(fn ($v, $k) => is_int($v));
        $this->assertTrue($result instanceof ArraySafe);
        $this->assertTrue($result->isEmpty() === false);
        $this->assertTrue($result->count() === 1);
        $this->assertTrue($result->first() === 3);
    }
}
