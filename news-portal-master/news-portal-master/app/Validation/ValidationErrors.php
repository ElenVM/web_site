<?php

namespace App\Validation;

class ValidationErrors
{
    /**
     * @var array
     */
    private $errors = [];

    public function add($key, $value)
    {
        $this->errors[$key][] = $value;
    }

    public function all()
    {
        return $this->errors;
    }

    public function has()
    {
        return count($this->errors) > 0;
    }
}