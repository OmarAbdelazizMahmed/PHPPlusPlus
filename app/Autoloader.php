<?php

class Autoloader
{
    public function __construct()
    {
        self::register();
    }
    
    public static function register()
    {
        spl_autoload_register(function ($class) {
            $file = APP . '/' . str_replace('\\', '/', $class) . '.php';
            if (file_exists($file)) {
                require_once $file;
                return true;
            }
            return false;
        });
    }
}
    