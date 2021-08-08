<?php

namespace Teofanis\LaravelUtils\Objects;

use Iterator;
use ArrayAccess;
use ArrayIterator;
use Illuminate\Support\Collection;

class ArraySafe implements ArrayAccess, Iterator
{
    private $iterator;
    private $default;

    public function __construct(iterable $items = [], $default = null)
    {
        $this->default = $default;
        $this->iterator = new ArrayIterator();
        foreach($items as $key => $item) {
            $this->offsetSet($key, $item);
        }
    }

    public function __call($method, $args)
    {
        if(!method_exists($this, $method)) {
            $collection = collect($this->getItems());
            if(method_exists($collection, $method) || $collection->hasMacro($method)) {
                $result = $collection->$method(...$args);
                if(!is_null($result) && is_scalar($result)) {
                    return $result;
                }
                if(is_array($result)) return $result;
                if($result instanceof Collection) return $result->toArray();
                return null;
                // return (!is_null($result) && is_scalar($result) ? $result : ($result ? $result->toArray() : null));
            }
        }
    }

    public function __get($offset)
    {
        return $this->offsetGet($offset);
    }

    public function getItems()
    {
        return $this->iterator->getArrayCopy();
    }

    public function getDefault()
    {
        return $this->default;
    }

    public function offsetExists($offset) : bool
    {
        return $this->iterator->offsetExists($offset);
    }

    public function offsetGet($offset)
    {
        return $this->iterator->offsetExists($offset) ? $this->iterator->offsetGet($offset) : $this->getDefault();
    }

    public function offsetSet($offset, $value) : void
    {
        $this->iterator->offsetSet($offset, $value);
    }

    public function offsetUnset($offset) : void
    {
        if($this->iterator->offsetExists($offset)) {
            $this->iterator->offsetUnset($offset);
        }
    }

    public function next() : void
    {
        $this->iterator->next();
    }

    public function key()
    {
        return $this->iterator->key();
    }

    public function valid() : bool
    {
        return $this->iterator->valid();
    }

    public function rewind() : void
    {
        $this->iterator->rewind();
    }

    public function count() : int
    {
        return $this->iterator->count();
    }

    public function current()
    {
        return $this->iterator->current();
    }

}
