<?php
declare(strict_types=1);


namespace App\Exception;

use App\Constant\ApiCode;
use Throwable;

class NotFoundAccountException extends ApiException
{
    public function __construct(
        string $message = 'Account does not exist',
        int $code = ApiCode::NOT_FOUND_ACCOUNT,
        string $error = '',
        Throwable $throwable = null
    )
    {
        parent::__construct($message, $code, $error, $throwable);
    }
}