<?php
declare(strict_types=1);


namespace App\Utils;

use App\Data\Permission as PermissionData;
use App\Model\SysUser;
use App\Module\System\Cache\UserLoginInfo;
use Hyperf\Context\ApplicationContext;
use Hyperf\HttpServer\Contract\RequestInterface;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\SimpleCache\CacheInterface;
use Psr\SimpleCache\InvalidArgumentException;
use RuntimeException;

class System
{
    public static function cache()
    {
        $container = ApplicationContext::getContainer();
        try {
            return $container->get(CacheInterface::class);
        } catch (NotFoundExceptionInterface|ContainerExceptionInterface $e) {
            throw new RuntimeException($e->getMessage());
        }
    }

    public static function request()
    {
        $container = ApplicationContext::getContainer();
        try {
            return $container->get(RequestInterface::class);
        } catch (NotFoundExceptionInterface|ContainerExceptionInterface $e) {
            throw new RuntimeException($e->getMessage());
        }
    }

    public static function getPermission(int $userId, string $permission): PermissionData|null
    {
        $permissions = self::getPermissions($userId);
        foreach ($permissions as $item) {
            if ($item->route == $permission) {
                return $item;
            }
        }

        return null;
    }

    public static function getPermissions(int $userId)
    {
        try {
            return UserLoginInfo::get($userId);
        } catch (InvalidArgumentException) {
            return [];
        }
    }

    public static function hashPermission(int $userId, string $permission): bool
    {
        return !!self::getPermission($userId, $permission);
    }

    public static function getAuthToken(RequestInterface $request = null): string
    {
        $request = $request ?? self::request();
        $token = $request->header('Authorization');
        if ($token) $token = str_replace('Basic ', '', $token);

        return $token ?? $request->input('_t', '');
    }

    public static function encodeUserPwd(string $pwd): string
    {
        return password_hash(md5(strrev($pwd)), PASSWORD_DEFAULT);
    }

    public static function verifyUserPwd(string $pwd, string $hashed): bool
    {
        return password_verify(md5(strrev($pwd)), $hashed);
    }

    /**
     * 获取客户端类型
     * @param RequestInterface|null $request
     * @return string
     */
    public static function getClientType(RequestInterface $request = null): string
    {
        $request = $request ?? self::request();
        return $request->header('X-CT') ?? $request->input('_ct', '');
    }

    /**
     * 获取客户端IP地址
     * @param RequestInterface|null $request
     * @return string
     */
    public static function getClientIp(RequestInterface $request = null): string
    {
        $request = $request ?? self::request();
        return $request->getServerParams()['REMOTE_ADDR'] ?? '';
    }
}