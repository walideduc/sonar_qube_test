<?php

namespace spec\App\Domain\Transaction\Service;

use App\Domain\Transaction\Dispatcher\TransactionEventDispatcherInterface;
use Tsi\Transaction\Entity\TransactionEntityInterface;
use App\Domain\Transaction\Repository\TransactionRepositoryInterface;
use PhpSpec\ObjectBehavior;

class TransactionServiceSpec extends ObjectBehavior
{
    function let(
        TransactionRepositoryInterface $transactionRepository,
        TransactionEventDispatcherInterface $transactionEventDispatcher
    ){
        $this->beConstructedWith(
            $transactionRepository,
            $transactionEventDispatcher
        );
    }

    function it_creates_or_update_a_transaction(
        TransactionEntityInterface $transactionEntity,
        TransactionRepositoryInterface $transactionRepository
    ){

        $transactionRepository
            ->save($transactionEntity)
            ->willReturn($transactionEntity);

        $this
            ->createOrUpdateTransaction(
                $transactionEntity
            )
            ->shouldReturn(
                $transactionEntity
            );
    }
}
