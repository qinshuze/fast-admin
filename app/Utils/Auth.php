<?php
declare(strict_types=1);


namespace App\Utils;

use App\Cache\AuthUser;
use App\Data\AuthPayload;
use App\Model\SysUser;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Psr\SimpleCache\InvalidArgumentException;
use RuntimeException;
use function Hyperf\Config\config;

class Auth
{
    /**
     * 获取认证数据
     * @param string $token
     * @return AuthPayload
     */
    public static function payload(string $token): AuthPayload
    {
        $payload = JWT::decode($token, new Key(config('app_jwt_secure'), 'HS256'));
        return new AuthPayload(
            $payload->userId,
            $payload->loginIp,
            $payload->iat,
            $payload->exp,
            $payload->clientType,
        );
    }

    /**
     * 获取认证令牌
     * @param AuthPayload $payload
     * @return string
     */
    public static function token(AuthPayload $payload): string
    {
        return JWT::encode((array) $payload, config('app_jwt_secure'), 'HS256');
    }

    /**
     * 获取登录认证令牌
     * @param SysUser $user
     * @param string $clientType
     * @return string
     */
    public static function login(SysUser $user, string $clientType): string
    {
        try {
            $time = time();
            AuthUser::set($user->id, $clientType, $user);
            return self::token(new AuthPayload(
                $user->id,
                $user->last_login_ip,
                $time,
                $time + config('app_jwt_ttl'),
                $clientType
            ));
        } catch (InvalidArgumentException $e) {
            throw new RuntimeException($e->getMessage());
        }
    }

    /**
     * 退出登录
     * @param string $token
     * @return void
     */
    public static function logout(string $token): void
    {
        try {
            $payload = self::payload($token);
            AuthUser::delete($payload->userId, $payload->clientType);
        } catch (InvalidArgumentException $e) {
            throw new RuntimeException($e->getMessage());
        }
    }

    /**
     * 获取当前登录用户
     * @param string|null $token
     * @return SysUser|null
     */
    public static function user(string $token = null): ?SysUser
    {
        $token = $token ?? System::getAuthToken();

        if ($token) {
            try {
                $payload = self::payload($token);
                return AuthUser::get($payload->userId, $payload->clientType);
            } catch (InvalidArgumentException $e) {
                throw new RuntimeException($e->getMessage());
            }
        }

        return null;
    }
}