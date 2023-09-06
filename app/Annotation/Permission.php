<?php
declare(strict_types=1);


namespace App\Annotation;

use Attribute;
use Hyperf\Di\Annotation\AbstractAnnotation;

/**
 * 权限注解
 * 当一个方法被标注上该注解后，在执行方法之前会先检查当前登录用户有没有对应的权限
 */
#[Attribute(Attribute::TARGET_METHOD)]
class Permission extends AbstractAnnotation
{
    /**
     * @param string $value
     * @param string $desc
     * @param string[] $tags
     */
    public function __construct(
        public readonly string $value,
        public readonly string $desc = '',
        public readonly array $tags = []
    )
    {
    }
}