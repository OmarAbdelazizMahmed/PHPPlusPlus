<?php

namespace PHPPlusPlus\Http;

use PHPPlusPlus\View\View;

class Route
{
    public Request $request;
    public Response $response;

    public function __construct(Request $request,Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public static array $routes = [];
    
    public static function get($path,callable|array|string $callback)
    {
        self::$routes['get'][$path] = $callback;
    }


    public static function post($path,callable|array|string $callback)
    {
        self::$routes['post'][$path] = $callback;
    }

    public function resolve()
    {
        $path = $this->request->path();
        $method = $this->request->method();
        $action = self::$routes[$method][$path] ?? false;

        if(!array_key_exists($path,self::$routes[$method])){
            return View::makeError('404');
        }
        if(is_callable($action)){
            return call_user_func_array($action,[]);
        }

        if (is_array($action)) {
            $controller = new $action[0]();
            $method = $action[1];
            return call_user_func_array([$controller,$method],[]);
        }
    }
}
