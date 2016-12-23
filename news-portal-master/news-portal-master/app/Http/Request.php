<?php

namespace App\Http;

class Request
{
    private static $ourInstance;

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

    public function post($key, $default = null)
    {
        return $_POST[$key] ?? $default;
    }

    public function file($key)
    {
        return $_FILES[$key] ?? null;
    }

    public function get($key, $default = null)
    {
        return $_GET[$key] ?? $default;
    }

    public function __get($name)
    {
        return $_REQUEST[$name] ?? null;
    }
}