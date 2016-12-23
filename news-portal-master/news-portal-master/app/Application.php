<?php

namespace App;

use App\Http\Response;
use Phroute\Phroute\RouteCollector;
use Pixie\Connection;

class Application
{
    /**
     * @var self
     */
    private static $ourInstance;

    /**
     * @var Connection
     */
    private $connection;

    /**
     * @var RouteCollector
     */
    private $router;

    private function __construct()
    {
        // Для предотвращения создания ненужных экземляров
    }

    public static function getInstance()
    {
        if (self::$ourInstance == null) {
            return self::$ourInstance = new self();
        }
        return self::$ourInstance;
    }

    public function dispatch(Response $response)
    {
        $response->send();
    }

    public function setConnection(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function getConnection() : Connection
    {
        return $this->connection;
    }

    public function setRouter($router)
    {
        $this->router = $router;
    }

    public function getRouter()
    {
        return $this->router;
    }
}