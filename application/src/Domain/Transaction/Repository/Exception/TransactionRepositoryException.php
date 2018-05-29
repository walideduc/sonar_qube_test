<?php

namespace App\Domain\Transaction\Repository\Exception;

use App\Infrastructure\NoSqlDatabase\Exception\NoSqlDatabaseException;
use RuntimeException;
class TransactionRepositoryException
    extends RuntimeException
{

    public static function createFromNoSqlDatabaseException( NoSqlDatabaseException $noSqlDatabaseException){

        return new static(
            $noSqlDatabaseException->getMessage(),
            $noSqlDatabaseException->getCode()
        );
    }
}