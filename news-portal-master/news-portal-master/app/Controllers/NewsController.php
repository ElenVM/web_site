<?php

namespace App\Controllers;

class NewsController extends Controller
{
    public function show($id)
    {
        $news = db()->table('news')->find($id);
        $image = db()->table('images')->find($news->image_id);

        if ($news == null) {
            abort('Запись не найдена');
        }

        return $this->view('news', compact('news', 'image'))->title(
            sprintf('Просмотр новости: %s', $news->title)
        );
    }
}