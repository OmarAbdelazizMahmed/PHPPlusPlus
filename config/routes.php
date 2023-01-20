<?php

$routes = [
    ['pattern' => '|^/$|', 'controller' => 'HomeController', 'action' => 'index'],
    ['pattern' => '|^/users|', 'controller' => 'UsersController', 'action' => 'index'],
    ['pattern' => '|^/users/(\d+)$|', 'controller' => 'UsersController', 'action' => 'view'],
];
