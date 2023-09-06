<?php
declare(strict_types=1);


namespace App\Cache;

use App\Model\SysUser;
use App\Utils\System;
use Psr\SimpleCache\InvalidArgumentException;

class AuthUser
{

    public static function key(int $id, string $clientType): string
    {
        return "Sys@AuthUser:$clientType:$id}";
    }

    /**
     * @param int $id
     * @param string $clientType
     * @return SysUser
     * @throws InvalidArgumentException
     */
    public static function get(int $id, string $clientType): SysUser
    {
        return System::cache()->get(self::key($id, $clientType));
    }

    /**
     * @param int $id
     * @param string $clientType
     * @param mixed $value
     * @param int $ttl
     * @return void
     * @throws InvalidArgumentException
     */
    public static function set(int $id, string $clientType, SysUser $value, int $ttl = 900): void
    {
        System::cache()->set(self::key($id, $clientType), $value, $ttl);
    }

    /**
     * @param int $id
     * @param string $clientType
     * @return void
     * @throws InvalidArgumentException
     */
    public static function delete(int $id, string $clientType): void
    {
        System::cache()->delete(self::key($id, $clientType));
    }
}