<?php
declare(strict_types=1);


namespace App\Request;


/**
 * 登录表单请求
 * @property string $account 账号
 * @property string $password 密码
 */
class LoginRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'account' => 'required',
            'password' => 'required'
        ];
    }
}