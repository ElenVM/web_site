<?php

namespace App\Controllers;

use App\Http\RedirectResponse;
use App\View;

abstract class Controller
{
    protected $layout = 'main';

    public function view(string $view, array $data = []) : View
    {
        return (new View($view))->data($data)->layout($this->layout);
    }

    public function redirect(string $to) : RedirectResponse
    {
        return new RedirectResponse($to);
    }
}