<?php

namespace PHPPlusPlus\Http;

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

        if($action === false){
            $this->response->setStatusCode(404);
            return "Not Found";
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
