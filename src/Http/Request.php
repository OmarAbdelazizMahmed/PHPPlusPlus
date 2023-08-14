<?php

namespace PHPPlusPlus\Http;

class Request
{
    public function path(): string
    {
        $path  = $_SERVER['REQUEST_URI'] ?? '/';
        $position = strpos($path, '?');
        return str_contains($path, '?') ? substr($path, 0, $position) : $path;
    }

    public function method(): string
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }
}