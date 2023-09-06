<?php

declare(strict_types=1);

namespace App\Model;


use Hyperf\Database\Model\Relations\BelongsToMany;
use Hyperf\Database\Query\Builder;

/**
 * @property int $id 
 * @property int $pid 上级菜单id
 * @property string $name 菜单名称
 * @property string $path 前端路径
 * @property string $permission 权限
 * @property string $icon 菜单图标
 * @property int $sort 排序字段：越大越靠前
 * @property int $enabled 已启用：1-是，0-否
 * @property int $create_time 创建时间
 * @property int $creator_id 创建人id
 * @mixin \App_Model_SysMenu
 */
class SysMenu extends Model
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'sys_menu';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = ['id', 'pid', 'name', 'path', 'permission', 'icon', 'sort', 'enabled', 'create_time', 'creator_id'];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['id' => 'integer', 'pid' => 'integer', 'sort' => 'integer', 'enabled' => 'integer', 'create_time' => 'integer', 'creator_id' => 'integer'];
}
