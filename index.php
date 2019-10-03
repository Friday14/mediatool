<?php

require __DIR__ . '/vendor/autoload.php';

use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\{Response, Request, RequestStack};
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\HttpKernel\EventListener\RouterListener;
use Symfony\Component\HttpKernel\{HttpKernel, KernelEvents};
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Loader\ClosureLoader as RouteClosureLoader;

// bootstrap http kernel
$closure = include __DIR__ . "/app/routes.php";
$loader = new RouteClosureLoader();
$routes = $loader->load($closure);

$request = Request::createFromGlobals();
$matcher = new UrlMatcher($routes, new RequestContext());

$dispatcher = new EventDispatcher();
$dispatcher->addSubscriber(new RouterListener($matcher, new RequestStack()));

// stub error handler
$dispatcher->addListener(KernelEvents::EXCEPTION, function ($event) {
    /** @var Symfony\Component\HttpKernel\Event\KernelEvent $event  */
    $exception = $event->getException();
    $event->setResponse(new Response(
        json_encode(['error' => $exception->getMessage()])
    ));
});

$controllerResolver = new ControllerResolver();

$kernel = new HttpKernel($dispatcher, $controllerResolver);

$response = $kernel->handle($request);
$response->send();

$kernel->terminate($request, $response);
