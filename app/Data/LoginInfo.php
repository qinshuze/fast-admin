<?php
declare(strict_types=1);


namespace App\Data;

use App\Model\SysUser;

class LoginInfo
{
    public string  $token;
    public SysUser $user;
}