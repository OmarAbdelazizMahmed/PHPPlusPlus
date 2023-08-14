<?php

use PHPPlusPlus\Http\Request;
use PHPPlusPlus\Http\Response;
use PHPPlusPlus\Http\Route;

require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/../routes/web.php';

$router = new Route(new Request(), new Response());

($router->resolve());