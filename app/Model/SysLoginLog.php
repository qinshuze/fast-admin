<?php

declare(strict_types=1);

namespace App\Model;



/**
 * @property int $id 
 * @property string $ip 登录ip
 * @property string $account 登录用户账号
 * @property int $login_time 登录时间
 * @property int $status 登录状态：1-成功，2-失败
 * @property string $status_msg 状态对应的消息说明
 * @property string $user_agent 用户代理
 * @mixin \App_Model_SysLoginLog
 */
class SysLoginLog extends Model
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'sys_login_log';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = ['id', 'ip', 'account', 'login_time', 'status', 'status_msg', 'user_agent'];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['id' => 'integer', 'login_time' => 'integer', 'status' => 'integer'];
}
