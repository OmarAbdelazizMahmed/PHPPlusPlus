<?php

namespace PHPPlusPlus\Support;

use ArrayAccess;

class Config implements ArrayAccess
{
    protected $items = [];

    public function __construct($items)
    {
        foreach ($items as $key => $value) {
            $this->items[$key] = $value;
        }
    }


    public function offsetGet(mixed $offset): mixed
    {
        return $this->get($offset);
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->set($offset, $value);
    }

    public function offsetExists(mixed $offset): bool
    {
        return $this->exists($offset);
    }


    public function offsetUnset(mixed $offset): void
    {
        $this->set($offset, null);
    }

    public function get($key, $default = null)
    {
        if(is_array($key)) {
            return $this->getMany($key);
        }

        return Arr::get($this->items, $key, $default);
    }

    public function getMany($keys)
    {
        $config = [];

        foreach ($keys as $key => $default) {
            if(is_numeric($key)) {
                [$key, $default] = [$default, null];
            }

            $config[$key] = Arr::get($this->items, $key, $default);
        }

        return $config;
    }

    public function set($key, $value = null)
    {
        $key = is_array($key) ? $key : [$key => $value];

        $this->setMany($key);
    }

    public function setMany($items)
    {
        foreach ($items as $key => $value) {
            Arr::set($this->items, $key, $value);
        }
    }

    public function push($key, $value = null)
    {
        $array = $this->get($key);

        if(is_null($array)) {
            $this->set($key, $value);
        } else {
            $this->set($key, array_merge($array, (array) $value));
        }
    }

    public function all()
    {
        return $this->items;
    }

    public function exists($key)
    {
        return Arr::exists($this->items, $key);
    }
}