<?php

use App\Event\EventDispatcher;
use Hyperf\Context\ApplicationContext;
use Hyperf\Event\ListenerProvider;

if (!function_exists('add_listener')) {
    function add_listener(string $event, callable $listener): void
    {
        $container = ApplicationContext::getContainer();
        $eventDispatcher = $container->get(Psr\EventDispatcher\EventDispatcherInterface::class);
        if (!($eventDispatcher instanceof EventDispatcher)) {
            throw new RuntimeException(get_class($eventDispatcher) . ' not ' . EventDispatcher::class);
        }

        if (!($eventDispatcher->listeners instanceof ListenerProvider)) {
            throw new RuntimeException(get_class($eventDispatcher->listeners) . ' not ' . ListenerProvider::class);
        }

        $eventDispatcher->listeners->on($event, $listener);
    }

    function del_listener(string $event, callable $listener = null): void
    {
        $container = ApplicationContext::getContainer();
        $eventDispatcher = $container->get(Psr\EventDispatcher\EventDispatcherInterface::class);
        if (!($eventDispatcher instanceof EventDispatcher)) {
            throw new RuntimeException(get_class($eventDispatcher) . ' not ' . EventDispatcher::class);
        }

        if (!($eventDispatcher->listeners instanceof ListenerProvider)) {
            throw new RuntimeException(get_class($eventDispatcher->listeners) . ' not ' . ListenerProvider::class);
        }

        $listeners = [];
        if (!$listener) {
            foreach ($eventDispatcher->listeners->listeners as $item) {
                if ($item->event != $event) {
                    $listeners[] = $listener;
                }
            }
        } else {
            foreach ($eventDispatcher->listeners->listeners as $item) {
                if ($item->event != $event && $item->listener != $listener) {
                    $listeners[] = $listener;
                }
            }
        }

        if (!empty($listeners)) {
            $eventDispatcher->listeners->listeners = $listeners;
        }

        $eventDispatcher->listeners->on($event, $listener);
    }
}
