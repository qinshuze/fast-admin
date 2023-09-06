<?php
declare(strict_types=1);


namespace App\Controller;

use App\Data\LoginInfo;
use App\Request\LoginRequest;
use App\Service\AuthService;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\RequestMapping;

#[Controller('/')]
class AuthController extends AbstractController
{
    #[RequestMapping('login', 'get')]
    public function login(LoginRequest $request, AuthService $service): LoginInfo
    {
        $loginInfo = $service->login($request);
        $loginInfo->user->setHidden(['create_time', 'creator_id', 'password']);
        return $loginInfo;
    }
}