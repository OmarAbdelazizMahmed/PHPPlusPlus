<?php

namespace PHPPlusPlus;

use PHPPlusPlus\Http\Request;
use PHPPlusPlus\Http\Response;
use PHPPlusPlus\Http\Route;

class Application
{
    protected Route $route;
    
    protected Request $request;

    protected Response $response;

    public function __construct()
    {
        $this->request = new Request();
        $this->response = new Response();
        $this->route = new Route($this->request, $this->response);
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
