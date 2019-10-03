<?php

use Symfony\Component\Routing\{RouteCollection, Route, Exception\NoConfigurationException};

/**
 * Closure for register routes
 *
 * @return RouteCollection
 */
return function (): RouteCollection {
    $routes = [
        '/' => [
            'controller' => \App\Controllers\HomeController::class,
            'methods' => ['GET']
        ],
        '/api/{service}' => [
            'controller' => \App\Controllers\ApiController::class,
            'action' => 'index',
            'methods' => ['GET']
        ],
    ];
    $routeCollection = new RouteCollection();

    foreach ($routes as $path => $params) {
        ['controller' => $controller, 'action' => $action, 'methods' => $methods] = $params;
        if (!isset($controller, $methods)) {
            throw new NoConfigurationException(sprintf('Route %s. No methods specified for the route', $path));
        }
        $action = $action ? '::' . $action : '';
        $routeCollection->add(
            $path,
            (new Route($path, ['_controller' => $controller . $action]))->setMethods($methods)
        );
    }

    return $routeCollection;
};
