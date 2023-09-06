<?php
declare(strict_types=1);


namespace App\Service;

use App\Annotation\LoginLog;
use App\Data\LoginInfo;
use App\Exception\NotFoundAccountException;
use App\Exception\PasswordVerifyFailException;
use App\Model\SysUser;
use App\Request\LoginRequest;
use App\Utils\Auth;
use App\Utils\System;
use function Hyperf\Config\config;

class AuthService
{
    /**
     * 密码登录
     * @param LoginRequest $request
     * @return LoginInfo
     */
    #[LoginLog]
    public function login(LoginRequest $request): LoginInfo
    {
        /** @var SysUser $user */
        $user = SysUser::where('account', $request->account)->first();
        if (!$user) throw new NotFoundAccountException();

        // 验证密码
        if ($user->password) {
            if (!System::verifyUserPwd($request->password, $user->password)) {
                throw new PasswordVerifyFailException();
            }
        } else {
            if ($request->password != config('user_default_pwd')) {
                throw new PasswordVerifyFailException();
            }
        }

        // 保存登录信息
        $user->last_login_ip   = System::getClientIp($request);
        $user->last_login_time = time();
        $user->save();

        $loginInfo        = new LoginInfo();
        $loginInfo->token = Auth::login($user, System::getClientType($request));
        $loginInfo->user  = $user;

        return $loginInfo;
    }
}