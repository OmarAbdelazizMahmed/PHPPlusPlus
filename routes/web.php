<?php

use App\Controllers\HomeController;
use PHPPlusPlus\Http\Route;

Route::get('/', [HomeController::class, 'index']);