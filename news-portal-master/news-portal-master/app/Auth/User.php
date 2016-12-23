<?php

namespace App\Auth;

/**
 * @property $id
 * @property $username
 * @property $password
 * @property $email
 * @property $remember_token
 * @property $created_at
 * @property $updated_at
 */
class User
{
    protected $attrs = [];
    protected $protected = ['password'];

    public function __construct($attrs)
    {
        $this->attrs = (array) $attrs;
    }

    public function __get($name)
    {
        return $this->attrs[$name] ?? null;
    }

    public function __set($name, $value)
    {
        if (!array_key_exists($name, $this->attrs)) {
            throw new \Exception('Can\'t find field [' . $name . '] in users table');
        }

        if (in_array($name, $this->protected)) {
            throw new \Exception('Field [' . $name . '] is protected');
        }

        $this->attrs[$name] = $value;
    }

    public function isAdmin() : bool
    {
        return $this->is_admin == 1;
    }
}