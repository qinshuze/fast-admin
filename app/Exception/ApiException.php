<?php
declare(strict_types=1);


namespace App\Exception;

use App\Constant\ApiCode;
use RuntimeException;
use Throwable;

class ApiException extends RuntimeException
{
    public function __construct(
        string                 $message = 'Internal Server Error',
        int                    $code = ApiCode::ERROR,
        public readonly string $error = '',
        Throwable              $throwable = null,
    )
    {
        parent::__construct($message, $code, $throwable);
    }
}