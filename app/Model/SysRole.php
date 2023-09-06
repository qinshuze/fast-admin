<?php

declare(strict_types=1);
namespace App\Model;


use Hyperf\Database\Model\Relations\BelongsToMany;
use Hyperf\Database\Model\Relations\HasMany;

/**
 * @property int $id 
 * @property string $name 角色名称
 * @property string $remark 角色备注
 * @property int $enabled 已启用：1-是，0-否
 * @property int $create_time 创建时间
 * @property int $creator_id 创建人id
 * @mixin \App_Model_SysRole
 */
class SysRole extends Model
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'sys_role';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = ['id', 'name', 'remark', 'enabled', 'create_time', 'creator_id'];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['id' => 'integer', 'enabled' => 'integer', 'create_time' => 'integer', 'creator_id' => 'integer'];
}
