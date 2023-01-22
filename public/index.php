<?php

// defind constants
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__DIR__));
define('APP', ROOT . DS . 'app');
define('CORE', ROOT . DS . 'core');
define('PUBLIC', ROOT . DS . 'public');
define('VIEWS', ROOT . DS . 'views');

use core\Injector;

require_once __DIR__ . '/../autoloader.php';
Autoloader::register();

$injector = new Injector();
$injector->register('Core\Database\DBConnectionInterface', 'Core\Database\DBConnection');


require_once '../config/routes.php';
try {
    $url = $_SERVER['REQUEST_URI'];
    foreach ($routes as $route) {
        if (preg_match($route['pattern'], $url, $matches)) {
            $controller = $route['controller'];
            $action = $route['action'];
            break;
        }
    }
    $controller = new $controller();
    $controller->$action();
    
} catch (Exception $e) {
    // handle errors
}

