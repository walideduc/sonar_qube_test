<?php

namespace App\Domain\Transaction\Service\Exception;

use App\Domain\Transaction\Repository\Exception\TransactionRepositoryException;
use RuntimeException;

class TransactionServiceException extends RuntimeException
{

    public static function createFromTransactionRepositoryException(
        TransactionRepositoryException $transactionRepositoryException
    ) {
        return new static(
            $transactionRepositoryException->getMessage(),
            $transactionRepositoryException->getCode()
        );
    }
}