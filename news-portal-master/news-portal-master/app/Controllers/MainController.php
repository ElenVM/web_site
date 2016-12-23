<?php

namespace App\Controllers;

class MainController extends Controller
{
    public function index()
    {
        $news = db()->table('news')->orderBy('id', 'desc')->get();

        return $this->view('index')->title('Главная страница')
            ->with('news', $news);
    }

    public function categories()
    {
        $categories = db()->table('news_categories')->orderBy('name')->get();

        return $this->view('categories')->title('Категории')
            ->with('categories', $categories);
    }

    public function category($id)
    {
        $category = db()->table('news_categories')->find($id);

        if ($category == null) {
            abort('Категория не существует');
        }

        $news = db()->table('news')->orderBy('id', 'desc')
            ->findAll('category_id', $id);

        return $this->view('category', compact('category', 'news'))->title(
            sprintf('Просмотр категории: %s', $category->name)
        );
    }

    public function contacts()
    {
        return $this->view('contacts')->title('Контакты');
    }
}