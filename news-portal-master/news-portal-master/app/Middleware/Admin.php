<?php

namespace App\Middleware;

use App\Auth\Auth;
use App\Http\RedirectResponse;

class Admin implements Middleware
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
        if (!$this->auth->check() || !$this->auth->user()->isAdmin()) {
            return (new RedirectResponse('/'))->withMessage('Нет доступа!');
        }

        return null;
    }
}