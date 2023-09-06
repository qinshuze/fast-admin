<?php

declare(strict_types=1);

namespace App\Model;



/**
 * @property int $id 
 * @property int $operate_log_id 操作日志id
 * @property string $request_url 请求url
 * @property string $request_headers 请求头信息
 * @property string $request_body 请求体
 * @property int $cid 操作的表数据id
 * @property string $old_data 旧数据
 * @property string $new_data 新数据
 * @mixin \App_Model_SysOperateLogInfo
 */
class SysOperateLogInfo extends Model
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'sys_operate_log_info';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = ['id', 'operate_log_id', 'request_url', 'request_headers', 'request_body', 'cid', 'old_data', 'new_data'];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['id' => 'integer', 'operate_log_id' => 'integer', 'cid' => 'integer'];
}
