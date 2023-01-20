<?php

// Define some constants
define('ROOT', __DIR__);
define('APP', ROOT . '/app');
define('CORE', ROOT . '/core');
define('CONFIG', ROOT . '/config');
define('PUBLIC', ROOT . '/public');

// Include the autoloader
require_once APP . '/Autoloader.php';
$autoloader = new Autoloader();


// Start the application
$app = new Application();
$app->run();


