<?php
declare(strict_types=1);


namespace App\Data;

class AuthPayload
{
    public function __construct(
        public readonly int    $userId,
        public readonly string $loginIp,
        public readonly int    $iat,
        public readonly int    $exp,
        public readonly string $clientType,
    )
    {
    }
}