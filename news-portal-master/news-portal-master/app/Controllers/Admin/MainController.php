<?php

namespace App\Controllers\Admin;

class MainController extends Controller
{
    public function index()
    {
        return $this->redirect('/admin/news');
    }
}