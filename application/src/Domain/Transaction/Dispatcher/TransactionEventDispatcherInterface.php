<?php

namespace App\Domain\Transaction\Dispatcher;

use Symfony\Component\EventDispatcher\Event;

/**
 * Interface TransactionEventDispatcherInterface
 * @package App\Domain\Transaction\Dispatcher
 */
interface TransactionEventDispatcherInterface
{
    /**
     * @param string $name
     * @param Event $event
     * @return mixed
     */
    public function dispatch(string $name, Event $event);
}