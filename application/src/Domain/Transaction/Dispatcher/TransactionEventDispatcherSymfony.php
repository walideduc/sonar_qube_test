<?php

namespace App\Domain\Transaction\Dispatcher;

use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class TransactionEventDispatcherSymfony
 * @package App\Domain\Transaction\Dispatcher
 */
class TransactionEventDispatcherSymfony implements TransactionEventDispatcherInterface
{
    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * TransactionEventDispatcherSymfony constructor.
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(EventDispatcherInterface $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @inheritdoc
     */
    public function dispatch(string $name, Event $event)
    {
        return $this->eventDispatcher->dispatch($name, $event);
    }
}