<?php
declare(strict_types=1);


namespace App\Event;

use App\Model\SysUser;

/**
 * 用户登出事件
 */
class UserLogout
{
    public function __construct(public readonly SysUser $user){}
}