<?php
declare(strict_types=1);


namespace App\Aop;

use App\Annotation\Permission;
use App\Utils\Auth;
use Donjan\Casbin\Enforcer;
use Hyperf\Di\Annotation\Aspect;
use Hyperf\Di\Aop\AbstractAspect;
use Hyperf\Di\Aop\ProceedingJoinPoint;
use Hyperf\HttpMessage\Exception\ForbiddenHttpException;
use Hyperf\HttpMessage\Exception\UnauthorizedHttpException;

/**
 * 权限认证切面
 */
#[Aspect]
class PermissionAuthAspect extends AbstractAspect
{

    public array $annotations = [
        Permission::class
    ];

    public function process(ProceedingJoinPoint $proceedingJoinPoint)
    {
        $metadata = $proceedingJoinPoint->getAnnotationMetadata();

        /** @var Permission $permission */
        $permission = $metadata->method[Permission::class] ?? null;
        if ($permission) {
            $user = Auth::user();
            if (!$user) throw new UnauthorizedHttpException();
            if (!Enforcer::enforce("user:$user->id", 'api', $permission->value)) throw new ForbiddenHttpException();
        }

        return $proceedingJoinPoint->process();
    }
}