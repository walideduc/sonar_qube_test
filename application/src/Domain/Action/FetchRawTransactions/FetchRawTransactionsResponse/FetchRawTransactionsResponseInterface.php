<?php

namespace App\Domain\Action\FetchRawTransactions\FetchRawTransactionsResponse;

use App\Domain\Transaction\Event\TransactionCreatedEvent\Collection\TransactionCreatedEventCollectionInterface;

interface FetchRawTransactionsResponseInterface
{

    /**
     * @param TransactionCreatedEventCollectionInterface $transactionCreatedEventCollection
     *
     * @return FetchRawTransactionsResponseInterface
     */
    public static function createFromTransactionCreatedEventCollection(
        TransactionCreatedEventCollectionInterface $transactionCreatedEventCollection
    ): FetchRawTransactionsResponseInterface;

    /**
     * @return mixed
     */
    public function __toString(): string;


    /**
     * @return array
     */
    public function toArray(): array;


}