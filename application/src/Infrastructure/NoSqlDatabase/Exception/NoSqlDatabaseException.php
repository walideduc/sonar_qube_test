<?php
namespace  App\Infrastructure\NoSqlDatabase\Exception ;
use Exception;
use RuntimeException;

class NoSqlDatabaseException extends RuntimeException
{
    public static function createFromMongoDBException(Exception $exception)
    {
        return new static(
            $exception->getMessage(),
            $exception->getCode()
        );
    }
}