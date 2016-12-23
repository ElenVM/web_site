<?php

namespace App\Auth;

class Auth
{
    /**
     * @var self
     */
    private static $ourInstance;

    /**
     * @var User|null
     */
    private $user = false;

    private function __construct()
    {
        //
    }

    public static function getInstance()
    {
        if (self::$ourInstance == null) {
            return self::$ourInstance = new self();
        }
        return self::$ourInstance;
    }

    public function check()
    {
        return $this->user() != null;
    }

    public function guest()
    {
        return !$this->check();
    }

    public function user()
    {
        if ($this->user !== false) {
            return $this->user;
        }

        $uid = $_SESSION['uid'] ?? null;
        $rememberToken = $_SESSION['remember_token'] ?? null;

        if (empty($uid) || empty($rememberToken)) {
            $this->destroy();
            return null;
        }

        $user = db()->table('users')->find($uid);

        if ($user == null) {
            $this->destroy();
            return null;
        }

        if (strcmp($user->remember_token, $rememberToken) !== 0) {
            $this->destroy();
            return null;
        }

        return $this->user = new User($user);
    }

    public function attempt($username, $password)
    {
        $user = db()->table('users')->find($username, 'username');

        if ($user == null) {
            return false;
        }

        if (!password_verify($password, $user->password)) {
            return false;
        }

        return $this->login($user);
    }

    public function login($user)
    {
        if (is_int($user)) {
            $user = db()->table('users')->find($user);
        }

        if ($user == null) {
            return false;
        }

        if ($user->remember_token == null) {
            db()->table('users')->where('id', $user->id)->update([
                'remember_token' => $user->remember_token = md5($user->id . $user->username . time())
            ]);
        }

        $_SESSION['uid'] = $user->id;
        $_SESSION['remember_token'] = $user->remember_token;

        $this->user = new User($user);

        return true;
    }

    public function logout()
    {
        if ($this->check()) {
            $this->destroy();
        }
    }

    private function destroy()
    {
        unset($_SESSION['uid']);
        unset($_SESSION['remember_token']);
    }
}