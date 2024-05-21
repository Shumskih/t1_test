<?php

namespace App\Rmvc\Route;

use Throwable;
use App\Web\Request;
use App\Web\Response;

class RouteDispatcher
{
    private string $requestUri = '/';
    private array $paramMap = [];
    private array $paramRequestMap = [];
    private RouteConfiguration $configuration;

    /**
     * @param RouteConfiguration $configuration
     */
    public function __construct(RouteConfiguration $configuration)
    {
        $this->configuration = $configuration;
    }

    public function process(): void
    {
        $this->saveRequestUri();
        $this->setParamMap();
        $this->makeRegexRequest();
        $this->run();
    }

    private function saveRequestUri(): void
    {
        if ($_SERVER['REQUEST_URI'] !== '/') {
            $this->requestUri = $this->clean($_SERVER['REQUEST_URI']);
            $this->configuration->route = $this->clean($this->configuration->route);
        }
    }

    private function clean(string $string): string
    {
        return preg_replace('/(^\/)|(\/$)/', '', $string);
    }

    private function setParamMap(): void
    {
        $routeArray = explode('/', $this->configuration->route);

        foreach ($routeArray as $key => $value) {
            if (preg_match('/{.*}/', $value)) {
                $this->paramMap[$key] = preg_replace('/(^{)|(}$)/', '', $value);
            }
        }
    }

    private function makeRegexRequest(): void
    {
        $requestUriArray = explode('/', $this->requestUri);

        foreach ($this->paramMap as $key => $value) {
            if (!isset($requestUriArray[$key])) {
                return;
            }

            $this->paramRequestMap[$value] = $requestUriArray[$key];
            $requestUriArray[$key] = '{.*}';
        }

        $this->requestUri = implode('/', $requestUriArray);
        $this->prepareRegex();
    }

    private function prepareRegex(): void
    {
        $this->requestUri = str_replace('/', '\/', $this->requestUri);
    }

    private function run(): void
    {
        if (preg_match("/$this->requestUri/", $this->configuration->route)) {
            $this->render();
        }
    }

    private function render(): void
    {
        $className = $this->configuration->controller;
        $action = $this->configuration->action;

        try {
            print((new $className)->$action(new Request(), new Response(), ...$this->paramRequestMap));
        } catch (Throwable $e) {
            $response = new Response();
            $response->setStatus($e->getCode() ?? 500);

            print($response->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]));
        }

        die();
    }
}
