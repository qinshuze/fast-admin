<?php
declare(strict_types=1);


namespace App\Cache;

use App\Data\Permission as PermissionData;
use App\Utils\System;
use Psr\SimpleCache\InvalidArgumentException;

class Permission
{
    public static function key(): string
    {
        return "Sys@Permssion";
    }

    /**
     * @return PermissionData[]
     * @throws InvalidArgumentException
     */
    public static function get(): array
    {
        return System::cache()->get(self::key());
    }

    /**
     * @param PermissionData[] $value
     * @param int $ttl
     * @return void
     * @throws InvalidArgumentException
     */
    public static function set(array $value, int $ttl = 900): void
    {
        System::cache()->set(self::key(), $value, $ttl);
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public static function delete(): void
    {
        System::cache()->delete(self::key());
    }
}