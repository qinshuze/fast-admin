<?php
declare(strict_types=1);


namespace App\Exception;

use App\Constant\ApiCode;
use Throwable;

class PasswordVerifyFailException extends ApiException
{
    public function __construct(
        string    $message = 'Password input error',
        int       $code = ApiCode::PASSWORD_VERIFY_FAIL,
        string    $error = '',
        Throwable $throwable = null
    )
    {
        parent::__construct($message, $code, $error, $throwable);
    }
}