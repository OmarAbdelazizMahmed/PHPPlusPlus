<?php

namespace PHPPlusPlus\Support;

class Arr
{
    public static function only(array $array, array|string $keys): array
    {
        return array_intersect_key($array, array_flip((array) $keys));  
    }

    public static function except(array $array, array|string $keys): array
    {
        return array_diff_key($array, array_flip((array) $keys));
    }

    public static function accessible($value): bool
    {
        return is_array($value) || $value instanceof \ArrayAccess;
    }

    public static function exists($array, $key): bool
    {
        if ($array instanceof \ArrayAccess) {
            return $array->offsetExists($key);
        }
        return array_key_exists($key, $array);
    }

    public static function has($array, $key): bool
    {
        if (is_null($key)) {
            return false;
        }
        $keys = (array) $key;
        if (!$array) {
            return false;
        }
        foreach ($keys as $key) {
            $subKeyArray = $array;
            if (static::exists($array, $key)) {
                continue;
            }
            foreach (explode('.', $key) as $segment) {
                if (static::accessible($subKeyArray) && static::exists($subKeyArray, $segment)) {
                    $subKeyArray = $subKeyArray[$segment];
                } else {
                    return false;
                }
            }
        }
        return true;
    }

    public static function get($array, $key, $default = null)
    {
        if (!static::accessible($array)) {
            return value($default);
        }
        if (is_null($key)) {
            return $array;
        }
        if (static::exists($array, $key)) {
            return $array[$key];
        }
        foreach (explode('.', $key) as $segment) {
            if (static::accessible($array) && static::exists($array, $segment)) {
                $array = $array[$segment];
            } else {
                return value($default);
            }
        }
        return $array;
    }

    public static function set(&$array, $key, $value): void
    {
        if (is_null($key)) {
            return;
        }
        $keys = (array) $key;
        while (count($keys) > 1) {
            $key = array_shift($keys);
            if (!static::exists($array, $key) || !static::accessible($array[$key])) {
                $array[$key] = [];
            }
            $array = &$array[$key];
        }
        $array[array_shift($keys)] = $value;
    }

    public static function last($array, callable $callback = null, $default = null)
    {
        if (is_null($callback)) {
            return empty($array) ? value($default) : end($array);
        }
        return static::first(array_reverse($array, true), $callback, $default);
    }

    public static function first($array, callable $callback = null, $default = null)
    {
        if (is_null($callback)) {
            if (empty($array)) {
                return value($default);
            }
            foreach ($array as $item) {
                return $item;
            }
        }
        foreach ($array as $key => $value) {
            if ($callback($value, $key)) {
                return $value;
            }
        }
        return value($default);
    }

    public static function forget(&$array, array|string $keys)
    {
        $original = &$array;
        $keys = (array) $keys;
        if (count($keys) === 0) {
            return;
        }
        foreach ($keys as $key) {
            if (static::exists($array, $key)) {
                unset($array[$key]);
                continue;
            }
            $parts = explode('.', $key);
            $array = &$original;
            while (count($parts) > 1) {
                $part = array_shift($parts);
                if (static::exists($array, $part) && is_array($array[$part])) {
                    $array = &$array[$part];
                } else {
                    continue 2;
                }
            }
            unset($array[array_shift($parts)]);
        }
    }

    public static function flatten($array, $depth = INF): array
    {
        $result = [];
        foreach ($array as $item) {
            if (!is_array($item)) { 
                $result[] = $item;
            } elseif ($depth === 1) {
                $result = array_merge($result, array_values($item));
            } else {
                $result = array_merge($result, static::flatten($item, $depth - 1));
            }
        }
        return $result;
    }
}