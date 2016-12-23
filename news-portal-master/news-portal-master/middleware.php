<?php

/** @var \Phroute\Phroute\RouteCollector $router */

/** @var array $middleware */
$middleware = config('middleware');

foreach ($middleware as $name => $class) {
    $router->filter($name, function () use ($class) {
        return (new $class)->handle();
    });
}