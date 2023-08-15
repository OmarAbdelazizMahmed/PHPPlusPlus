<?php

use PHPPlusPlus\Http\Request;
use PHPPlusPlus\Http\Response;
use PHPPlusPlus\Http\Route;

require_once __DIR__ . '/../src/Support/helpers.php';
require_once base_path() . '/vendor/autoload.php';

require_once base_path() . '/routes/web.php';

$router = new Route(new Request(), new Response());

($router->resolve());