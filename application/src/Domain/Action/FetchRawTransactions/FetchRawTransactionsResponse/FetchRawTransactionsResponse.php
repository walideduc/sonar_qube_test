<?php

namespace App\Domain\Action\FetchRawTransactions\FetchRawTransactionsResponse;

use App\Domain\Transaction\Event\TransactionCreatedEvent\Collection\TransactionCreatedEventCollectionInterface;

/**
 * Class FetchRawTransactionsResponse
 *
 * @package App\Domain\Action\FetchRawTransactions\FetchRawTransactionsResponse
 */
class FetchRawTransactionsResponse
    implements FetchRawTransactionsResponseInterface
{

    /**
     * @var TransactionCreatedEventCollectionInterface
     */
    private $transactionCreatedEventCollection;

    /**
     * FetchRawTransactionsResponse constructor.
     *
     * @param TransactionCreatedEventCollectionInterface $transactionCreatedEventCollection
     */
    private function __construct(
        TransactionCreatedEventCollectionInterface $transactionCreatedEventCollection
    ) {
        $this->transactionCreatedEventCollection
            = $transactionCreatedEventCollection;
    }


    /**
     * @inheritdoc
     */
    public static function createFromTransactionCreatedEventCollection(
        TransactionCreatedEventCollectionInterface $transactionCreatedEventCollection
    ): FetchRawTransactionsResponseInterface {
        return new static (
            $transactionCreatedEventCollection
        );
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        return $this
            ->transactionCreatedEventCollection
            ->toArray();
    }

    /**
     * @inheritdoc
     */
    public function __toString(): string
    {
        return
            json_encode(
                $this->toArray()
            );
    }

}