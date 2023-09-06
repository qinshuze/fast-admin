<?php

declare(strict_types=1);

namespace App\Model;


use App\Data\Permission;
use App\Data\UserPermission;
use Hyperf\Database\Model\Relations\BelongsToMany;

/**
 * @property int $id 
 * @property string $account 账号
 * @property string $nickname 昵称
 * @property string $password 登录密码
 * @property string $avatar 头像
 * @property string $email 邮箱号
 * @property int $enabled 已启用：1-是，0-否
 * @property string $last_login_ip 最后登录ip
 * @property int $last_login_time 最后登录时间
 * @property int $create_time 创建时间
 * @property int $creator_id 创建人id，没有则为0
 * @mixin \App_Model_SysUser
 */
class SysUser extends Model
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'sys_user';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = ['id', 'account', 'nickname', 'password', 'avatar', 'email', 'enabled', 'last_login_ip', 'last_login_time', 'create_time', 'creator_id'];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['id' => 'integer', 'enabled' => 'integer', 'last_login_time' => 'integer', 'create_time' => 'integer', 'creator_id' => 'integer'];
}
