<?php

namespace App\Router;

use Illuminate\Routing\Router as BaseRouter;

class Router
{
    protected $router;

    protected $endpoints;

    protected $controller_lookup;

    protected $namespace = 'App\Http\Controllers';

    public function __construct(BaseRouter $router)
    {
        $this->endpoints         = array_except(config('endpoints'), 'endpoints');
        $this->router            = $router;
        $this->controller_lookup = config("endpoints.endpoints");
    }

    public function setRoutes()
    {
        $this->setStaticRoutes();
        $this->setDynamicRoutes();
    }

    protected function setStaticRoutes()
    {
        $this->router->get('/', function () {
            return redirect('/jobs');
        });

        $this->router->get('/thank-you', ['as' => 'thank_you', 'middleware' => ['web'], function () {
            return view('thank-you');
        }]);

        $this->router->get('/about', ['as' => 'about', function () {
            return view('about');
        }]);
    }

    protected function setDynamicRoutes()
    {
        foreach ($this->endpoints as $base => $endpoint_group) {
            foreach ($endpoint_group as $endpoint) {
                $controller  = $this->getController($base);
                $path        = $this->getRoutePath($base, $endpoint);
                $params      = $this->getRouteParams($controller, $endpoint);
                $http_method = $this->getHTTPMethod($endpoint);

                $this->router->$http_method("{$path}", $params);
            }
        }
    }

    protected function getController($base)
    {
        $controller = array_get($this->controller_lookup, $base);
        return "{$this->namespace}\\{$controller}";
    }

    protected function getHTTPMethod($endpoint)
    {
        return array_get($endpoint, 'type', 'get');
    }

    protected function getRouteParams($controller, $endpoint)
    {
        $method     = array_get($endpoint, 'method');
        $name       = array_get($endpoint, 'name');
        $middleware = array_get($endpoint, 'middleware');
        $controller = array_get($endpoint, 'controller', $controller);

        return array_filter([
            'uses'       => "{$controller}@{$method}",
            'as'         => $name,
            'middleware' => $middleware,
        ]);
    }

    protected function getRoutePath($base, $endpoint)
    {
        $path = array_get($endpoint, 'path');
        return "/{$base}{$path}";
    }
}
