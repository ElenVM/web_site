<?php

define('BASE_PATH', dirname(__DIR__));

define('VIEWS_PATH',   BASE_PATH . '/views');
define('LAYOUTS_PATH', BASE_PATH . '/layouts');
define('APP_PATH',     BASE_PATH . '/app');
define('CONFIG_PATH',  BASE_PATH . '/config');
define('PUBLIC_PATH',  BASE_PATH . '/public');
define('MENU_PATH',    BASE_PATH . '/menu');

// Подключение загрузчика классов
require_once BASE_PATH . '/vendor/autoload.php';
require_once BASE_PATH . '/functions.php';

try {

    // Запуск сессии
    session_start();

    $router = new \Phroute\Phroute\RouteCollector();
    // Подключение фильтров
    require_once BASE_PATH . '/middleware.php';
    // Подключение роутов
    require_once BASE_PATH . '/routes.php';

    $resolver = new \App\Routing\RouterResolver(
        config('routing.namespace')
    );

    // Подключение к базе данных
    $connection = new \Pixie\Connection('mysql', config('database'), 'DB');

    $application = \App\Application::getInstance();
    $application->setConnection($connection);
    $application->setRouter($router);

    $dispatcher = new \Phroute\Phroute\Dispatcher($router->getData(), $resolver);

    // Обрабатываем запрос
    $response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'],
        parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

    // Выводим ответ
    $application->dispatch($response);

} catch (\App\Exceptions\HttpResponseException $e) {
    handle_response($e->response);
} catch (Exception $e) {
    echo $e->getMessage();
}