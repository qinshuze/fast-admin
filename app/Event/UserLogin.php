<?php
declare(strict_types=1);


namespace App\Event;

use App\Model\SysUser;

/**
 * 用户登录事件
 */
class UserLogin
{
    public function __construct(public readonly SysUser $user){}
}