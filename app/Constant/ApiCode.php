<?php
declare(strict_types=1);


namespace App\Constant;

class ApiCode
{
    public const OK                   = 0;       // 成功
    public const ERROR                = -1;      // 未知错误
    public const NOT_FOUND_ACCOUNT    = 10001;   // 找不到账号
    public const PASSWORD_VERIFY_FAIL = 10002;   // 密码验证失败
    public const PARAMS_VERIFY_FAIL   = 20001;   // 提交的参数未通过验证
}