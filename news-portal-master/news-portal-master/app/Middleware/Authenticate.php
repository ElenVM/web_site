<?php

namespace App\Middleware;

use App\Auth\Auth;
use App\Http\RedirectResponse;

class Authenticate implements Middleware
{
    /**
     * @var Auth
     */
    private $auth;

    public function __construct()
    {
        $this->auth = Auth::getInstance();
    }

    public function handle()
    {
        if (!$this->auth->check()) {
            return (new RedirectResponse('/'))->withMessage('Необходима авторизация!');
        }

        return null;
    }
}