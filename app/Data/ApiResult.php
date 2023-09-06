<?php
declare(strict_types=1);


namespace App\Data;

use App\Constant\ApiCode;

class ApiResult
{
    public function __construct(
        public string $msg = 'ok',
        public int    $code = ApiCode::OK,
        public mixed  $data = [],
    )
    {
    }
}