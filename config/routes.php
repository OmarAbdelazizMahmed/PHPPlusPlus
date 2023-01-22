<?php

use app\Controllers\HomeController;

$routes = [
    ['pattern' => '|^/$|', 'controller' => HomeController::class, 'action' => 'index'],
    ['pattern' => '|^/users$|', 'controller' => UsersController::class, 'action' => 'index'],
    ['pattern' => '|^/users/(\d+)$|', 'controller' => UsersController::class, 'action' => 'view'],
];
