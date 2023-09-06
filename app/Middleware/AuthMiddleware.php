<?php
declare(strict_types=1);


namespace App\Middleware;

use App\Utils\Auth;
use App\Utils\System;
use Firebase\JWT\SignatureInvalidException;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpMessage\Exception\UnauthorizedHttpException;
use Hyperf\HttpServer\Contract\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * 用户认证中间件
 */
class AuthMiddleware implements MiddlewareInterface
{
    #[Inject]
    protected RequestInterface $request;

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $token = System::getAuthToken($this->request);
        if (!$token) throw new UnauthorizedHttpException();
        $user = Auth::user($token);
        if (!$user) throw new SignatureInvalidException();

        return $handler->handle($request);
    }
}