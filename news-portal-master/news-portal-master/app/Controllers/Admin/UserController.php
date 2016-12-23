<?php

namespace App\Controllers\Admin;

use App\Http\Request;
use App\Validation\Validator;
use Carbon\Carbon;

class UserController extends Controller
{
    public function index()
    {
        $users = db()->table('users')->orderBy('id', 'desc')->get();

        return $this->view('admin/users/index', compact('users'))
            ->title('Управление пользователями');
    }

    public function store()
    {
        $validator = new Validator();
        $request = Request::getInstance();

        $password = password_hash($request->post('password'), PASSWORD_BCRYPT);
        $date = Carbon::now()->toDateTimeString();

        db()->table('users')->insert([
            'username' => $request->post('username'),
            'password' => $password,
            'email' => $request->post('email'),
            'created_at' => $date,
            'updated_at' => $date,
        ]);

        return $this->redirect('/admin/users')->withMessage('Пользователь успешно добавлен');
    }

    public function edit($id)
    {
        //
    }

    public function update($id)
    {
        //
    }

    public function destroy($id)
    {
        db()->table('users')->where('id', $id)->delete();

        return $this->redirect('/admin/users')->withMessage('Пользователь успешно удалён');
    }
}