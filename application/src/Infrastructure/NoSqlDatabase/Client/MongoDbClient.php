<?php
/**
 * Created by PhpStorm.
 * User: mohamedkeita
 * Date: 27/12/2017
 * Time: 15:40
 */

namespace App\Infrastructure\NoSqlDatabase\Client;

use App\Infrastructure\NoSqlDatabase\Collection\MongoDbCollection;
use MongoDB\Client;
use App\Infrastructure\NoSqlDatabase\Collection\NoSqlDatabaseCollectionInterface;

final class MongoDbClient implements NoSqlDatabaseClientInterface
{

    /**
     * @var Client
     */
    private $mongoClient;

    /**
     * MongoDbClient constructor.
     *
     * @param Client $mongoClient
     */
    public function __construct(Client $mongoClient)
    {
        $this->mongoClient = $mongoClient;
    }


    /**
     * @inheritdoc
     */
    public function collection(
        string $databaseName,
        string $collectionName
    ): NoSqlDatabaseCollectionInterface {

        return new MongoDbCollection(
            $this
                ->mongoClient
                ->selectCollection(
                    $databaseName,
                    $collectionName
                )
        );
    }

}