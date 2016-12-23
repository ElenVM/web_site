<?php

namespace App\Validation;

class Validator
{
    /**
     * @var array
     */
    private $rules = [];

    /**
     * @var ValidationErrors
     */
    private $errors;

    public function __construct()
    {
        $this->errors = new ValidationErrors();
    }

    public function addRule(string $key, callable $callback)
    {
        $this->rules[$key] = $callback;
    }

    public function validate()
    {
        foreach ($this->rules as $key => $rule) {
            $error = call_user_func($rule, $this->get($key));
            if ($error === true) continue;
            $this->errors()->add($key, $error);
        }

        return !$this->errors()->has();
    }

    public function errors() : ValidationErrors
    {
        return $this->errors;
    }

    private function get($key)
    {
        return $_REQUEST[$key] ?? $_FILES[$key] ?? null;
    }
}