<?php

namespace App\Routing;

use Phroute\Phroute\HandlerResolverInterface;

class RouterResolver implements HandlerResolverInterface
{
    private $namespace;

    public function __construct($namespace)
    {
        $this->namespace = $namespace;
    }

    public function resolve($handler)
    {
        if (is_string($handler) && strpos($handler, '@') !== false) {
            list($controller, $action) = explode('@', $handler);
            $controller = $this->namespace . '\\' . $controller;
            return [new $controller, $action];
        }

        return $handler;
    }
}