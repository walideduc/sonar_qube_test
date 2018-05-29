<?php

namespace App\Domain\Transaction\Event\TransactionCreatedEvent\Collection;

use App\Domain\Transaction\Event\TransactionCreatedEvent\TransactionCreatedEventInterface;

interface TransactionCreatedEventCollectionInterface
{

    /**
     * @return array
     */
    public function toArray(): array;

    /**
     * @param TransactionCreatedEventInterface $transactionCreatedEvent
     *
     * @return mixed
     */
    public function add(
        TransactionCreatedEventInterface $transactionCreatedEvent
    );
}