<?php

namespace App\Controllers\Admin;

use App\Http\Request;
use App\Validation\Validator;
use Carbon\Carbon;

class NewsController extends Controller
{
    public function index()
    {
        $categories = db()->table('news_categories')->orderBy('name')->get();
        $news = db()->table('news')->orderBy('id', 'desc')->get();

        return $this->view('admin/news/index')->title('Управление новостями')
            ->with('categories', $categories)
            ->with('news', $news);
    }

    public function store()
    {
        $validator = $this->validator();
        $request = Request::getInstance();

        if (!$validator->validate()) {
            return $this->redirect('/admin/news')->withErrors(
                $validator->errors()->all()
            );
        }

        $file = $request->file('image');
        $path = $file['tmp_name'];

        $name = sprintf('%s.%s', sha1_file($path), pathinfo($file['name'], PATHINFO_EXTENSION));
        $date = Carbon::now()->toDateTimeString();

        $id = db()->table('images')->insert([
            'client_name' => $file['name'],
            'name' => $name,
        ]);

        $moved = move_uploaded_file($path, sprintf('%s/%s/%s', PUBLIC_PATH, 'img/uploaded', $name));

        if ($moved == false) {
            abort('Ошибка перемещания изображения');
        }

        db()->table('news')->insert([
            'user_id' => auth()->user()->id,
            'category_id' => $request->post('category'),
            'image_id' => $id,
            'title' => $request->post('title'),
            'content' => $request->post('content'),
            'created_at' => $date,
            'updated_at' => $date,
        ]);

        return $this->redirect('/admin/news')->withMessage('Новость успешно добавлена');
    }

    protected function validator()
    {
        $validator = new Validator();
        $request = Request::getInstance();
        $file = $request->file('image');

        $validator->addRule('title', function ($value) {
            if (empty($value)) {
                return 'Необходимо указать заголовок';
            }
            return true;
        });

        $validator->addRule('category', function ($value) {
            if (empty($value)) {
                return 'Необходимо выбрать категорию';
            }
            if (!db()->table('news_categories')->find($value)) {
                return 'Недопустимая категория';
            }
            return true;
        });

        $validator->addRule('image', function () use ($file) {
            if (empty($file)) {
                return 'Необходимо выбрать изображение';
            }
            if ($file['error'] != UPLOAD_ERR_OK) {
                return 'Ошибка загрузки изображения';
            }
            if ($file['size'] > config('upload.filesize')) {
                return 'Максимальный размер файла 5MB';
            }
            if (!preg_match('~image/.*~', $file['type'])) {
                return 'Недопустимый формат изображения';
            }
            return true;
        });

        $validator->addRule('content', function ($value) {
            if (empty($value)) {
                return 'Содержимое не может быть пустым';
            }
            return true;
        });

        return $validator;
    }
}