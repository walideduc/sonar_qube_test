<?php

namespace spec\App\Domain\Transaction\Repository;

use Tsi\Transaction\Entity\TransactionEntityInterface;
use Tsi\Transaction\Hydrator\ConsolidatedTransaction\ConsolidatedTransactionHydratorInterface;
use App\Infrastructure\NoSqlDatabase\Collection\NoSqlDatabaseCollectionInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TransactionRepositorySpec extends ObjectBehavior
{
    function let(
        ConsolidatedTransactionHydratorInterface $hydrator,
        NoSqlDatabaseCollectionInterface $collection
    ){
        $this->beConstructedWith($hydrator,$collection);
    }

}
