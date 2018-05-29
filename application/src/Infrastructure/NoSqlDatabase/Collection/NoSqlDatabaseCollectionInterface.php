<?php

namespace App\Infrastructure\NoSqlDatabase\Collection;

interface NoSqlDatabaseCollectionInterface
{

    /**
     * @param $data
     * @param $filters
     *
     * @return mixed
     */
    public function upsert(array $data, array $filters);

    /**
     * @param $pipeline array
     */
    public function aggregate(array  $pipeline);


    /**
     * @param array $filter
     * @param array $options
     * @return mixed
     */
    public function findOne(array $filter = [], array $options = []);

    /**
     * @param array $filter
     * @param array $options
     * @return mixed
     */
    public function find(array $filter = [], array $options = []);

    /**
     * @param array $filter
     * @param array $set
     * @return mixed
     */
    public function updateOne(array $filter = [], array $set);

    /**
     * @param $filter
     * @param $update
     * @return mixed
     */
    public function updateMany(array $filter = [], array $update);

}