<?php

namespace App\Controllers\Auth;

use App\Controllers\Controller;
use App\Http\Request;
use App\Validation\Validator;

class LoginController extends Controller
{
    public function login()
    {
        $validator = new Validator($_POST);
        $request = Request::getInstance();

        $validator->addRule('username', function ($value) {
            if (empty($value)) {
                return 'Необходимо ввести логин';
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

        if (!$validator->validate()) {
            return $this->redirect('/')->withErrors(
                $validator->errors()->all()
            );
        }

        $passed = auth()->attempt($request->post('username'), $request->post('password'));

        return $this->redirect('/')->withMessage(
            $passed ? 'Вы успешно авторизовались' : 'Неверный логин или пароль'
        );
    }
}