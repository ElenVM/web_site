<?php

namespace App;

use App\Http\Response;

class View extends Response
{
    /**
     * Имя файла представления
     *
     * @var string
     */
    private $view;

    /**
     * Имя файла шаблона
     *
     * @var false|string
     */
    private $layout = false;

    /**
     * Массив данных
     *
     * @var array
     */
    private $data = [];

    /**
     * @var array
     */
    private $stacks = [];

    /**
     * @var array
     */
    private $temp = [];

    public function __construct(string $view)
    {
        $this->view = $view;
        $this->verify();
    }

    private function verify()
    {
        if (!file_exists($this->getPath())) {
            throw new \Exception('View file [' . $this->getPath() . '] not found');
        }
    }

    public function layout(string $layout) : self
    {
        $this->layout = $layout;
        return $this;
    }

    public function data(array $data) : self
    {
        $this->data = $data;
        return $this;
    }

    public function with($key, $value) : self
    {
        $this->data[$key] = $value;
        return $this;
    }

    public function title(string $title) : self
    {
        return $this->with('__title', $title);
    }

    private function getContent(string $__path, array $__data) : string
    {
        ob_start();

        extract($__data);

        /** @noinspection PhpIncludeInspection */
        require $__path;

        return ob_get_clean();
    }

    public function render() : string
    {
        $content = $this->getContent($this->getPath(), $this->data);

        if ($this->layout == false) {
            return $content;
        }

        $data = ['__content' => $content] + $this->data;

        return $this->getContent($this->getLayoutPath(), $data);
    }

    private function getPath() : string
    {
        return sprintf('%s/%s.php', VIEWS_PATH, $this->view);
    }

    private function getLayoutPath() : string
    {
        return sprintf('%s/%s.php', LAYOUTS_PATH, $this->layout);
    }

    public function begin(string $stack)
    {
        ob_start();

        $this->temp[ob_get_level()] = $stack;
    }

    public function push()
    {
        $level = ob_get_level();

        if (!array_key_exists($level, $this->temp)) {
            return null;
        }

        $stack = $this->temp[$level];

        if (!array_key_exists($stack, $this->stacks)) {
            $this->stacks[$stack] = [];
        }

        $this->stacks[$stack][] = ob_get_clean();
    }

    public function stack(string $stack)
    {
        if (!array_key_exists($stack, $this->stacks)) {
            return null;
        }

        return implode(PHP_EOL, $this->stacks[$stack]);
    }

    public function view(string $view)
    {
        return (new self($view))->data($this->data)->render();
    }

    public function toResponse()
    {
        echo $this->render();
    }
}