<?php
/**
 * Created by PhpStorm.
 * User: mohamedkeita
 * Date: 27/12/2017
 * Time: 15:45
 */

namespace App\Infrastructure\NoSqlDatabase\Collection;


use App\Infrastructure\NoSqlDatabase\Exception\NoSqlDatabaseException;
use MongoDB\Collection;
use MongoDB\Exception\InvalidArgumentException;
use MongoDB\Exception\RuntimeException;
use MongoDB\Exception\UnsupportedException;

class MongoDbCollection implements NoSqlDatabaseCollectionInterface
{

    /**
     * @var Collection
     */
    private $collection;

    /**
     * MongoDbCollection constructor.
     *
     * @param Collection $collection
     */
    public function __construct(Collection $collection)
    {
        $this->collection = $collection;
    }


    /**
     * @param $data
     * @param $filters
     * @return void
     */
    public function upsert(array $data, array $filters)
    {
        try {
            $this->collection->updateOne(
                $filters, ['$set' => $data], ['upsert' => true]
            );
        } catch (UnsupportedException |
        InvalidArgumentException |
        RuntimeException $exception) {
            throw NoSqlDatabaseException::createFromMongoDBException($exception);
        }
    }

    /**
     * @inheritdoc
     */
    public function aggregate(array $pipeline)
    {
        $result = $this->collection->aggregate($pipeline);
        return $result;
    }

    /**
     * @inheritdoc
     */
    public function findOne(array $filter = [], array $options = [])
    {
        return $this->collection->findOne($filter,$options);
    }

    /**
     * @inheritdoc
     */
    public function find(array $filter = [], array $options = [])
    {
        return $this->collection->find($filter,$options);
    }

    public function updateOne(array $filter = [], array $update)
    {
        return $this->collection->updateOne($filter, $update);
    }

    public function updateMany(array $filter = [], array $update)
    {
        return $this->collection->updateMany($filter, $update);
    }
}