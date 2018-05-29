<?php

namespace App\Domain\Transaction\Event;

use Symfony\Component\EventDispatcher\Event;
use Tsi\Transaction\Entity\TransactionEntityInterface;

class ConsolidatedTransactionCreatedEvent extends Event implements ConsolidatedTransactionCreatedEventInterface
{
    /**
     * @var TransactionEntityInterface
     */
    private $consolidatedTransaction ;

    public function __construct(TransactionEntityInterface $consolidatedTransaction)
    {
        $this->consolidatedTransaction = $consolidatedTransaction;
    }


    public function getConsolidatedTransactionEntity(): TransactionEntityInterface
    {
        return $this->consolidatedTransaction;
    }
}