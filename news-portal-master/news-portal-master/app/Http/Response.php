<?php

namespace App\Http;

abstract class Response
{
    /**
     * @var array
     */
    protected $headers = [];

    /**
     * @var int
     */
    protected $statusCode = 200;

    /**
     * @var string
     */
    protected $statusText = '';

    /**
     * @var string
     */
    protected $version = '1.1';

    /**
     * Добавляет заголовок к ответу
     *
     * @param $name
     * @param $value
     * @return $this
     */
    public function header($name, $value)
    {
        $this->headers[$name] = $value;
        return $this;
    }

    /**
     * Отправлет ответ
     */
    public function send()
    {
        $this->sendHeaders();
        $this->toResponse();
    }

    /**
     * Отправляет заголовки
     */
    private function sendHeaders()
    {
        foreach ($this->headers as $name => $value) {
            header($name . ': ' . $value, true);
        }

        header(sprintf('HTTP/%s %s %s', $this->version, $this->statusCode, $this->statusText),
            true, $this->statusCode);
    }

    /**
     * Отправляет ответ пользователю
     *
     * @return mixed
     */
    public abstract function toResponse();
}