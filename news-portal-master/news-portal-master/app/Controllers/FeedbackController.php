<?php

namespace App\Controllers;

use App\Http\Request;
use App\Validation\Validator;

class FeedbackController extends Controller
{
    public function submit()
    {
        $validator = new Validator($_POST);
        $request = Request::getInstance();

        $validator->addRule('name', function ($value) {
            if (empty($value)) {
                return 'Необходимо указать имя';
            }
            return true;
        });

        $validator->addRule('email', function ($value) {
            if (empty($value)) {
                return 'Необходимо указать E-mail';
            }
            if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                return 'Недопустимый E-mail';
            }
            return true;
        });

        $validator->addRule('title', function ($value) {
            if (empty($value)) {
                return 'Необходимо указать заголовок';
            }
            return true;
        });

        $validator->addRule('message', function ($value) {
            if (empty($value)) {
                return 'Необходимо указать сообщение';
            }
            return true;
        });

        if (!$validator->validate()) {
            return $this->redirect('/contacts')->withErrors(
                $validator->errors()->all()
            );
        }

        $mail = new \PHPMailer();
        $config = config('mail');

        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = $config['host'];
        $mail->Username = $config['username'];
        $mail->Password = $config['password'];
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('feedback@news-portal.dev', 'Форма обратной связи [news-portal]');
        $mail->addAddress($config['email']);

        $body  = 'Имя: ' . $request->post('name') . PHP_EOL;
        $body .= 'Заголовок: ' . $request->post('title') . PHP_EOL;
        $body .= 'E-mail: ' . $request->post('email') . PHP_EOL;
        $body .= 'Сообщение: ' . $request->post('message') . PHP_EOL;

        $mail->CharSet = $config['charset'];
        $mail->Subject = $request->post('title');
        $mail->Body = $body;

        $mail->send() or abort('Ошибка отправки сообщения');

        return $this->redirect('/contacts')->withMessage('Сообщение успешно отправлено');
    }
}