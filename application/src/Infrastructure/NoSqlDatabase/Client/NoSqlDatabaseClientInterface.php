<?php

namespace App\Infrastructure\NoSqlDatabase\Client;

use App\Infrastructure\NoSqlDatabase\Collection\NoSqlDatabaseCollectionInterface;

interface NoSqlDatabaseClientInterface
{
    /**
     * @param string $databaseName
     * @param string $collectionName
     *
     * @return NoSqlDatabaseCollectionInterface
     */
    public function collection(
        string $databaseName,
        string $collectionName
    ): NoSqlDatabaseCollectionInterface;
}