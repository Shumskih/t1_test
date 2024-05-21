<?php

namespace App\Rmvc;

use App\Rmvc\Route\Route;
use App\Rmvc\Route\RouteDispatcher;

class App
{
    public static function run(): void
    {
        $requestMethod = ucfirst(strtolower($_SERVER['REQUEST_METHOD']));
        $methodName = 'getRoutes' . $requestMethod;

        foreach (Route::$methodName() as $configuration) {
            (new RouteDispatcher($configuration))->process();
        }
    }
}
