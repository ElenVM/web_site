<?php

function app()
{
    return \App\Application::getInstance();
}

function config($key, $default = null)
{
    return \App\Support\Config::getInstance()->get($key, $default);
}

function db() : \Pixie\QueryBuilder\QueryBuilderHandler
{
    return app()->getConnection()->getQueryBuilder();
}

function request() : \App\Http\Request
{
    return \App\Http\Request::getInstance();
}

function auth() : \App\Auth\Auth
{
    return \App\Auth\Auth::getInstance();
}

function handle_response(\App\Http\Response $response)
{
    app()->dispatch($response);
}

function dd()
{
    array_map(function ($value) {
        (new Symfony\Component\VarDumper\Dumper\HtmlDumper)->dump(
            (new \Symfony\Component\VarDumper\Cloner\VarCloner)->cloneVar($value)
        );
    }, func_get_args());
    exit(1);
}

function url($url)
{
    if (func_num_args() > 1) {
        $url = call_user_func_array([app()->getRouter(), 'route'], func_get_args());
    }

    $url = '/' . ltrim($url, '/');

    return $url;
}

function asset($path)
{
    return '/' . $path;
}

function menu($menu)
{
    $file = sprintf('%s/%s.php', MENU_PATH, $menu);

    if (!file_exists($file)) {
        throw new Exception('Menu file [' . $file . '] not found');
    }

    /** @noinspection PhpIncludeInspection */
    return (array) require $file;
}

function abort($message)
{
    throw new \App\Exceptions\HttpResponseException(
        (new \App\View('error'))->layout('main')->with('message', $message)
    );
}

function e($string)
{
    return htmlspecialchars($string, ENT_HTML5, 'UTF-8');
}