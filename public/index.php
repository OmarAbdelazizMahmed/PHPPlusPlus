<?php

use Core\Injector;

require_once '../autoloader.php';
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
?>
