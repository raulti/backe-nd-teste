<?php

namespace App\Exceptions;
use Exception;

abstract class BusinessException extends Exception
{
    protected $id;
    protected $details;

    public function __construct($message)
    {
        parent::__construct($message, 404);
    }

    protected function create(array $args)
    {
        $error = array_shift($args);
        return $this->details = vsprintf($error, $args);
    }
}