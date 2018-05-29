<?php

namespace App\Domain\Transaction\Subscriber\CreateConsolidatedTransaction\Exception;

use App\Domain\Transaction\Service\Exception\TransactionServiceException;
use RuntimeException;

class CreateConsolidatedTransactionSubscriberException extends RuntimeException
{

    public static function createFromTransactionServiceException(
        TransactionServiceException $transactionServiceException
    ) {
        return new static(
            $transactionServiceException->getMessage(),
            $transactionServiceException->getCode()
        );
    }
}