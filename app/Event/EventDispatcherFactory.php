<?php
declare(strict_types=1);

namespace App\Event;

use Hyperf\Contract\StdoutLoggerInterface;
use Psr\Container\ContainerInterface;
use Psr\EventDispatcher\ListenerProviderInterface;

/**
 * 事件调度器工厂
 * 代替框架中自带的事件调度器工厂
 */
class EventDispatcherFactory
{
    public function __invoke(ContainerInterface $container): EventDispatcher
    {
        $listeners = $container->get(ListenerProviderInterface::class);
        $stdoutLogger = $container->get(StdoutLoggerInterface::class);
        return new EventDispatcher($listeners, $stdoutLogger);
    }
}