<?php


namespace App\Domain\Transaction\Event\TransactionCreatedEvent\Collection;

use App\Domain\Transaction\Event\TransactionCreatedEvent\TransactionCreatedEventInterface;
use dgifford\Traits\IteratorTrait;
use Iterator;

class TransactionCreatedEventCollection implements
    TransactionCreatedEventCollectionInterface,
    Iterator
{

    use IteratorTrait;

    /**
     * @var array
     */
    private $container = [];

    /**
     * @inheritdoc
     */
    public function add(
        TransactionCreatedEventInterface $transactionCreatedEvent
    ): TransactionCreatedEventCollectionInterface {

        $this->container[] = $transactionCreatedEvent;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        $events = [];
        foreach ($this->container as $event) {
            $events[] = $event->toArray();
        }

        return $events;
    }
}