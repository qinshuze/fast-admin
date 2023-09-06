<?php
declare(strict_types=1);

namespace App\Aop;

use App\Annotation\AfterCallback;
use App\Annotation\AroundCallback;
use App\Annotation\BeforeCallback;
use Hyperf\Di\Annotation\Aspect;
use Hyperf\Di\Aop\AbstractAspect;
use Hyperf\Di\Aop\ProceedingJoinPoint;

/**
 * 回调处理切面
 */
#[Aspect]
class CallbackAspect extends AbstractAspect
{

    public array $annotations = [
        BeforeCallback::class,
        AfterCallback::class,
        AroundCallback::class,
    ];

    public function process(ProceedingJoinPoint $proceedingJoinPoint)
    {
        $metadata = $proceedingJoinPoint->getAnnotationMetadata();

        /** @var BeforeCallback $before */
        $before = $metadata->method[BeforeCallback::class] ?? null;

        /** @var AfterCallback $before */
        $after = $metadata->method[AfterCallback::class] ?? null;

        /** @var AroundCallback $before */
        $around = $metadata->method[AroundCallback::class] ?? null;

        $before && call_user_func_array($before->handler, $before->arguments);
        $around && call_user_func_array($around->handler, $around->arguments);
        $result = $proceedingJoinPoint->process();
        $around && call_user_func_array($around->handler, $around->arguments);
        $after && call_user_func_array($after->handler, $after->arguments);

        return $result;
    }
}