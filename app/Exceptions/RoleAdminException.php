<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class RoleAdminException extends Exception
{
    
    public function __construct (mixed $message = null, int $code = 0, Throwable|null $previous = null)
    {
        $message = 'Role must admin!';
        parent::__construct((string)$message, $code, $previous);
    }
}
