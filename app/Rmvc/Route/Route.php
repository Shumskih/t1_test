<?php

namespace App\Rmvc\Route;

class Route
{
    private static array $routesGet = [];
    private static array $routesPost = [];
    private static array $routesDelete = [];

    public static function get(string $route, array $controller): RouteConfiguration
    {
        $routeConfiguration = new RouteConfiguration($route, $controller[0], $controller[1]);
        self::$routesGet[] = $routeConfiguration;

        return $routeConfiguration;
    }

    public static function post(string $route, array $controller): RouteConfiguration
    {
        $routeConfiguration = new RouteConfiguration($route, $controller[0], $controller[1]);
        self::$routesPost[] = $routeConfiguration;

        return $routeConfiguration;
    }

    public static function delete(string $route, array $controller): RouteConfiguration
    {
        $routeConfiguration = new RouteConfiguration($route, $controller[0], $controller[1]);
        self::$routesDelete[] = $routeConfiguration;

        return $routeConfiguration;
    }

    public static function redirect(string $url): void
    {
        header('Location: ' . $url);
    }

    public static function getRoutesGet(): array
    {
        return self::$routesGet;
    }

    public static function getRoutesPost(): array
    {
        return self::$routesPost;
    }

    public static function getRoutesDelete(): array
    {
        return self::$routesDelete;
    }
}