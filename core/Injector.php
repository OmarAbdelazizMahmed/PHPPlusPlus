<?php

namespace core;

class Injector
{
    private $dependencies = [];

    public function register($name, $callback)
    {
        $this->dependencies[$name] = $callback;
    }

    public function resolve($name)
    {
        if (!isset($this->dependencies[$name])) {
            return new $name;
        }
        
        $dependency = $this->dependencies[$name];

        if (is_callable($dependency)) {
            return $dependency();
        }

        return new $dependency;
    }
}