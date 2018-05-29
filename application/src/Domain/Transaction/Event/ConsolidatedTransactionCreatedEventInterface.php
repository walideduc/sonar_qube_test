<?php

namespace App\Domain\Transaction\Event;



use Tsi\Transaction\Entity\TransactionEntityInterface;

interface ConsolidatedTransactionCreatedEventInterface
{
    const NAME = 'consolidated-transaction.created' ;

    public function getConsolidatedTransactionEntity() : TransactionEntityInterface;
}