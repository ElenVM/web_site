<?php

namespace App\Support;

class Config
{
    private static $ourInstance;

    // Кэшируем загруженные конфиги в памяти
    private $cache = [];

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

    public function get($key, $default = null)
    {
        if (strpos($key, '.') === false) {
            return $this->{$key};
        }

        $name = substr($key, 0, strpos($key, '.'));
        $config = $this->{$name};

        $path = substr($key, strlen($name) + 1);
        $path = explode('.', $path);

        for ($i = 0; $i < count($path); ++$i) {
            $config = $config[$path[$i]] ?? null;
            if ($config == null) return $default;
        }

        return $config;
    }

    public function __get($name)
    {
        if (array_key_exists($name, $this->cache)) {
            return $this->cache[$name];
        }

        $file = sprintf('%s/%s.php', CONFIG_PATH, $name);

        if (!file_exists($file)) {
            throw new \Exception('File not found [' . $file . ']');
        }

        /** @noinspection PhpIncludeInspection */
        $config = (array) require $file;

        return $this->cache[$name] = $config;
    }
}