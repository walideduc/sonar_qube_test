<?php

namespace App\Domain\Action\FetchRawTransactions;

use App\Domain\Action\FetchRawTransactions\FetchRawTransactionsResponse\FetchRawTransactionsResponse;
use App\Domain\Action\FetchRawTransactions\FetchRawTransactionsResponse\FetchRawTransactionsResponseInterface;
use App\Domain\Transaction\Dispatcher\TransactionEventDispatcherInterface;
use App\Domain\Transaction\Event\TransactionCreatedEvent\Collection\TransactionCreatedEventCollectionInterface;
use App\Domain\Transaction\Event\TransactionCreatedEvent\TransactionCreatedEvent;
use App\Infrastructure\QueueSystem\Client\ClientInterface;
use App\Infrastructure\QueueSystem\Message\SqsMessage;

/**
 * Class FetchRawTransactions
 *
 * @package App\Domain\Action\FetchRawTransactions
 */
class FetchRawTransactions implements FetchRawTransactionsInterface
{
    /**
     * @var ClientInterface
     */
    private $sqsClient;

    /**
     * @var TransactionEventDispatcherInterface
     */
    private $transactionEventDispatcher;

    /**
     * @var TransactionCreatedEventCollectionInterface
     */
    private $transactionCreatedEventCollection;

    /**
     * FetchRawTransactions constructor.
     *
     * @param ClientInterface                            $sqsClient
     * @param TransactionEventDispatcherInterface        $transactionEventDispatcher
     * @param TransactionCreatedEventCollectionInterface $transactionCreatedEventCollection
     */
    public function __construct(
        ClientInterface $sqsClient,
        TransactionEventDispatcherInterface $transactionEventDispatcher,
        TransactionCreatedEventCollectionInterface $transactionCreatedEventCollection
    ) {
        $this->sqsClient = $sqsClient;
        $this->transactionEventDispatcher = $transactionEventDispatcher;
        $this->transactionCreatedEventCollection
            = $transactionCreatedEventCollection;
    }


    /**
     * @inheritdoc
     */
    public function fetch(): FetchRawTransactionsResponseInterface
    {
        $messages = $this->sqsClient->receive();

        foreach ($messages as $key => $message) {
            /**
             * @var $message SqsMessage
             */
            $event = $this
                ->transactionEventDispatcher
                ->dispatch(
                    TransactionCreatedEvent::NAME,
                    new TransactionCreatedEvent($message)
                );

            /**
             * @var $event TransactionCreatedEvent
             */
            if ($event->isMessageProcessed()) {
                $this->sqsClient->consume($message->getReceiptHandle());
            }

            $this->transactionCreatedEventCollection
                ->add($event);
        }

        return FetchRawTransactionsResponse::createFromTransactionCreatedEventCollection(
            $this->transactionCreatedEventCollection
        );
    }
}