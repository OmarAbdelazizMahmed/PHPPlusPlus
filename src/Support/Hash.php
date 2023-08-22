<?php

namespace PHPPlusPlus\Support;

class Hash
{
    public static function make($value, array $options = [])
    {
        $hash = password_hash($value, PASSWORD_DEFAULT, $options);

        if ($hash === false) {
            throw new \RuntimeException('Bcrypt hashing not supported.');
        }

        return $hash;
    }

    public static function check($value, $hashedValue)
    {
        if (strlen($hashedValue) === 0) {
            return false;
        }

        return password_verify($value, $hashedValue);
    }
}