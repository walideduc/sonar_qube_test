<?php

namespace App\Infrastructure\NoSqlDatabase\Collection\Factory;

use App\Infrastructure\NoSqlDatabase\Client\MongoDbClient;

class MongoDbCollectionFactory
{

    /**
     * @var MongoDbClient
     */
    private $mongoDbClient;

    /**
     * MongoDbCollectionFactory constructor.
     *
     * @param MongoDbClient $mongoDbClient
     */
    public function __construct(MongoDbClient $mongoDbClient)
    {
        $this->mongoDbClient = $mongoDbClient;
    }


    public function collection(
        string $databaseName,
        string $collectionName
    ) {

        return $this
            ->mongoDbClient
            ->collection(
                $databaseName,
                $collectionName
            );
    }
}