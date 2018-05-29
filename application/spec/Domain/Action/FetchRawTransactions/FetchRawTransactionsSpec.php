<?php

namespace spec\App\Domain\Action\FetchRawTransactions;

use App\Domain\Action\FetchRawTransactions\FetchRawTransactionsResponse\FetchRawTransactionsResponseInterface;
use App\Domain\Transaction\Dispatcher\TransactionEventDispatcherInterface;
use App\Domain\Transaction\Event\TransactionCreatedEvent\Collection\TransactionCreatedEventCollectionInterface;
use App\Infrastructure\QueueSystem\Client\ClientInterface;
use PhpSpec\ObjectBehavior;

class FetchRawTransactionsSpec extends ObjectBehavior
{
    function let(
        ClientInterface $sqsClient,
        TransactionEventDispatcherInterface $transactionEventDispatcher,
        TransactionCreatedEventCollectionInterface $transactionCreatedEventCollection
    ){
        $this->beConstructedWith(
            $sqsClient,
            $transactionEventDispatcher,
            $transactionCreatedEventCollection
        );
    }

    function it_fetches_raw_transactions_and_return_a_response(
        ClientInterface $sqsClient
    ){

        $sqsClient
            ->receive()
            ->willReturn([]);

            $this
                ->fetch()
                ->shouldReturnAnInstanceOf(FetchRawTransactionsResponseInterface::class);
    }
}
