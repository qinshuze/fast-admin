<?php

declare(strict_types=1);

namespace App\Model;



/**
 * @property int $id 
 * @property string $title 标题
 * @property int $type 操作类型：1-新增，2-编辑，3-删除
 * @property int $user_id 操作人id
 * @property int $operate_time 操作时间
 * @property string $ip 操作的客户端ip地址
 * @property string $route 操作路由
 * @property int $status 操作状态：1-成功，2-失败
 * @property string $status_msg 操作状态对应的消息说明
 * @mixin \App_Model_SysOperateLog
 */
class SysOperateLog extends Model
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'sys_operate_log';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = ['id', 'title', 'type', 'user_id', 'operate_time', 'ip', 'route', 'status', 'status_msg'];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['id' => 'integer', 'type' => 'integer', 'user_id' => 'integer', 'operate_time' => 'integer', 'status' => 'integer'];
}
