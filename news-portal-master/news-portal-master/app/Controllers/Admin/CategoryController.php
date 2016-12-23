<?php

namespace App\Controllers\Admin;

use App\Validation\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = db()->table('news_categories')->orderBy('name')->get();

        return $this->view('admin/categories/index', compact('categories'))
            ->title('Управление категориями');
    }

    public function store()
    {
        $validator = new Validator();

        $validator->addRule('name', function ($value) {
            if (empty($value)) {
                return 'Необходимо указать название';
            }
            return true;
        });

        if (!$validator->validate()) {
            return $this->redirect('/admin/categories')->withErrors(
                $validator->errors()->all()
            );
        }

        db()->table('news_categories')->insert([
            'name' => request()->post('name'),
        ]);

        return $this->redirect('/admin/categories')->withMessage('Категория успешно добавлена');
    }

    public function destroy($id)
    {
        db()->table('news_categories')->where('id', $id)->delete();

        return $this->redirect('/admin/categories')->withMessage('Категория успешно удалена');
    }
}