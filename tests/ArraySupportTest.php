<?php

namespace Teofanis\LaravelUtils\Tests;

use Teofanis\LaravelUtils\Facades\Utils;

class ArraySupportTest extends TestCase
{
    protected $array;

    public function setUp(): void
    {
        parent::setUp();
        $this->array = [
            'someKey' => 'test',
            'key' => [
                'test' => 'something',
                'key' => 'test2',
                'test3' => ['key' => 'deep'],
            ],
            'nokey' => 'somekey',
            'test3' => [
                'key' => 'another',
            ],
            'last' => 'key',
        ];
    }

    /** @test */
    public function test_replaces_array_keys()
    {
        $array = $this->array;
        $expected = [
            'someKey' => 'test',
            'newKey' => [
                'test' => 'something',
                'newKey' => 'test2',
                'test3' => ['newKey' => 'deep'],
            ],
            'nokey' => 'somekey',
            'test3' => [
                'newKey' => 'another',
            ],
            'last' => 'key',
        ];

        $result = Utils::replaceKeys('key', 'newKey', $array);
        $this->assertEquals($expected, $result);
    }

    public function test_replaces_multiple_array_keys()
    {
        $array = $this->array;
        $expected = [
            'newReplacedKey' => 'test',
            'deepkey' => [
                'test' => 'something',
                'deepkey' => 'test2',
                'test3' => ['deepkey' => 'deep'],
            ],
            'anotherReplacedKey' => 'somekey',
            'test3' => [
                'deepkey' => 'another',
            ],
            'ops' => 'key',
        ];
        $keysToReplace = [
            'someKey' => 'newReplacedKey',
            'nokey' => 'anotherReplacedKey',
            'last' => 'ops',
            'key' => 'deepkey',
        ];
        $result = Utils::replaceMultipleKeys($keysToReplace, $array);
        $this->assertEquals($expected, $result);
    }

    public function test_prefixes_array_keys()
    {
        $array = $this->array;
        $keyPrefix = "item.";
        $expected = [
            'item.someKey' => 'test',
            'item.key' => [
                'test' => 'something',
                'key' => 'test2',
                'test3' => ['key' => 'deep'],
            ],
            'item.nokey' => 'somekey',
            'item.test3' => [
                'key' => 'another',
            ],
            'item.last' => 'key',
        ];

        $result = Utils::prefixKeys($keyPrefix, $array);
        $this->assertEquals($expected, $result);
    }

    public function test_prefixes_array_keys_deep()
    {
        $array = $this->array;
        $keyPrefix = "item.";
        $expected = [
            'item.someKey' => 'test',
            'item.key' => [
                'item.test' => 'something',
                'item.key' => 'test2',
                'item.test3' => ['item.key' => 'deep'],
            ],
            'item.nokey' => 'somekey',
            'item.test3' => [
                'item.key' => 'another',
            ],
            'item.last' => 'key',
        ];

        $result = Utils::prefixKeys($keyPrefix, $array, true);
        $this->assertEquals($expected, $result);
    }

    public function test_removes_array_key_prefixes()
    {
        $prefix = "item.";
        $array = Utils::prefixKeys($prefix, $this->array);
        $expected = [
            'someKey' => 'test',
            'key' => [
                'test' => 'something',
                'key' => 'test2',
                'test3' => ['key' => 'deep'],
            ],
            'nokey' => 'somekey',
            'test3' => [
                'key' => 'another',
            ],
            'last' => 'key',
        ];
        $result = Utils::removeKeyPrefixes($prefix, $array);
        $this->assertEquals($expected, $result);
    }

    public function test_removes_array_key_prefixes_deep()
    {
        $prefix = "item.";
        $array = Utils::prefixKeys($prefix, $this->array, true);
        $expected = [
            'someKey' => 'test',
            'key' => [
                'test' => 'something',
                'key' => 'test2',
                'test3' => ['key' => 'deep'],
            ],
            'nokey' => 'somekey',
            'test3' => [
                'key' => 'another',
            ],
            'last' => 'key',
        ];
        $result = Utils::removeKeyPrefixes($prefix, $array, true);
        $this->assertEquals($expected, $result);
    }
}
