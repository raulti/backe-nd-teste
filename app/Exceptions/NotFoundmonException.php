<?php

namespace App\Exceptions;

class NotFoundmonException extends  BusinessException
{
    public function __construct()
    {
        $message = $this->create(func_get_args());
        parent::__construct($message);
    }
}
