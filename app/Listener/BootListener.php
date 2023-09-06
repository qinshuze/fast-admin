<?php
declare(strict_types=1);


namespace App\Listener;

use App\Annotation\Permission;
use Hyperf\Di\Annotation\AnnotationCollector;
use Hyperf\Event\Annotation\Listener;
use Hyperf\Event\Contract\ListenerInterface;
use Hyperf\Framework\Event\BeforeServerStart;
use Hyperf\Framework\Event\BootApplication;
use RuntimeException;

/**
 * 应用启动监听器
 */
#[Listener]
class BootListener implements ListenerInterface
{

    public function listen(): array
    {
        return [
            BootApplication::class,
            BeforeServerStart::class,
        ];
    }

    public function process(object $event): void
    {
        $permissions = [];
        $annotations = AnnotationCollector::getMethodsByAnnotation(Permission::class);
        foreach ($annotations as $annotation) {
            /** @var Permission[] $annotations */
            $permission = $annotation['annotation'];
            if (isset($permissions[$permission->value])) {
                throw new RuntimeException("Duplicate permission values '$permission->value'");
            }
            $permissions[$permission->value] = $permission;
        }

        var_dump($permissions);
    }
}