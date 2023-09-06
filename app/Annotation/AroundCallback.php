<?php
declare(strict_types=1);

namespace App\Annotation;

use Attribute;
use Hyperf\Di\Annotation\AbstractAnnotation;

/**
 * 操作环绕回调注解
 * 当一个方法被标注上该注解后，在执行方法之前和之后都会执行注解中定义的回调操作
 */
#[Attribute(Attribute::TARGET_METHOD)]
class AroundCallback extends AbstractAnnotation
{
    public function __construct(public string|array $handler, public array $arguments = [])
    {
    }
}