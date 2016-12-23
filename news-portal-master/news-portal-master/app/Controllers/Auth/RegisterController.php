<?php

namespace App\Controllers\Auth;

use App\Controllers\Controller;
use App\Validation\Validator;
use Carbon\Carbon;

class RegisterController extends Controller
{
    public function index()
    {
        return $this->view('auth/register')->title('Регистрация');
    }

    public function register()
    {
        $validator = new Validator($_POST);

        $validator->addRule('username', function ($value) {
            if (empty($value)) {
                return 'Необходимо ввести логин';
            }
            if (db()->table('users')->where('username', $value)->count()) {
                return 'Указанный логин уже используется';
            }
            if (!preg_match('/[a-z0-9_-]{4,16}/i', $value)) {
                return 'Недопустимый логин';
            }
            return true;
        });

        $validator->addRule('password', function ($value) {
            if (empty($value)) {
                return 'Пароль не может быть пустой';
            }
            if (strlen($value) < 4 || strlen($value) > 64) {
                return 'Длина пароля должна составлять от 4 до 64 символов';
            }
            return true;
        });

        $validator->addRule('password_c', function ($value) {
            if (empty($value)) {
                return 'Введите подверждение пароля';
            }
            if (request()->password != $value) {
                return 'Пароли не совпадают';
            }
            return true;
        });

        $validator->addRule('email', function ($value) {
            if (empty($value)) {
                return 'Введите Ваш E-mail';
            }
            if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                return 'Недопустимый E-mail';
            }
            return true;
        });

        if (!$validator->validate()) {
            return $this->redirect('/register')->withErrors(
                $validator->errors()->all()
            );
        }

        $password = request()->password;
        $password = password_hash($password, PASSWORD_BCRYPT);

        $date = Carbon::now()->toDateTimeString();

        $id = db()->table('users')->insert([
            'username' => request()->username,
            'password' => $password,
            'email' => request()->email,
            'created_at' => $date,
            'updated_at' => $date,
        ]);

        auth()->login($id) or abort('Что-то пошло не так, попробуйте авторизоваться вручную');

        return $this->redirect('/')->withMessage('Регистрация успешно завершена');
    }
}