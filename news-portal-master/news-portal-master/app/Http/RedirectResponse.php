<?php

namespace App\Http;

class RedirectResponse extends Response
{
    /**
     * Ссылка для перенаправления
     *
     * @var string
     */
    private $url;

    /**
     * Сообщение
     *
     * @var string
     */
    private $message;

    /**
     * Задержка перед перенаправлением
     *
     * @var int
     */
    private $delay = 0;

    /**
     * Список значений для записи в сессии
     *
     * @var array
     */
    private $sessions = [];

    /**
     * RedirectResponse constructor.
     *
     * @param string $url
     * @param string $message
     * @param int $code
     */
    public function __construct($url, $message = null, $code = 302)
    {
        $this->url = $url;
        $this->message = $message;
        $this->statusCode = $code;
    }

    /**
     * Устанавливает задержку
     *
     * @param int $delay
     */
    public function delay(int $delay)
    {
        $this->delay = $delay;
    }

    /**
     * Записывает сообщение в сессию
     *
     * @param $message
     * @return $this
     */
    public function withMessage($message)
    {
        $this->sessions['message'] = $message;
        return $this;
    }

    /**
     * Записывает ошибки в сессию
     *
     * @param array $errors
     * @return $this
     */
    public function withErrors(array $errors)
    {
        $this->sessions['errors'] = $errors;
        return $this;
    }

    public  function toResponse()
    {
        if (count($this->sessions)) {
            foreach ($this->sessions as $key => $value) {
                $_SESSION[$key] = $value;
            }
        }

        if ($this->delay > 0) {
            header(sprintf('Refresh: %d; url: %s', $this->delay, $this->url));
        } else {
            header(sprintf('Location: %s', $this->url));
        }

        echo $this->message;
    }
}