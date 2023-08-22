<?php

namespace PHPPlusPlus;

use PHPPlusPlus\Http\Request;
use PHPPlusPlus\Http\Response;
use PHPPlusPlus\Http\Route;
use PHPPlusPlus\Support\Config;

class Application
{
    protected Route $route;
    
    protected Request $request;

    protected Response $response;

    protected Config $config;

    public function __construct()
    {
        $this->request = new Request();
        $this->response = new Response();
        $this->route = new Route($this->request, $this->response);
        $this->config = new Config($this->loadConfigurations());
    }

    protected function loadConfigurations()
    {
        foreach(scandir(config_path()) as $file) {
            if ($file === '.' || $file === '..') {
                continue;
            }

            $fileName = str_replace('.php', '', $file);

            yield $fileName => require config_path() . $file;
        }
    }

    public function run()
    {
        $this->route->resolve();
    }

    public function __get($name)
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        }
    }
}
