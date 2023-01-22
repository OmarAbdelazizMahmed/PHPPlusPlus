<?php
namespace app\Controllers;

class HomeController {
    public function index()
    {
        $viewPath = __DIR__ . '/../Views/Home/index.view.php';
        require_once $viewPath;       
    }
}