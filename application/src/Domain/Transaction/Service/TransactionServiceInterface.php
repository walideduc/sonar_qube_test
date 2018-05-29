<?php

namespace App\Domain\Transaction\Service;

use App\Domain\Transaction\Entity\Search\Request\SearchRequestEntityInterface;
use Tsi\Transaction\Entity\TransactionEntityInterface;

interface TransactionServiceInterface
{
    /**
     * @param TransactionEntityInterface $consolidatedTransactionEntity
     *
     * @return mixed
     */
    public function createOrUpdateTransaction(
        TransactionEntityInterface $consolidatedTransactionEntity
    ): TransactionEntityInterface;

    public function searchTransaction(SearchRequestEntityInterface $searchRequestEntity);

    /**
     * @param string $ref
     * @param array $attributesValue
     * @return TransactionEntityInterface
     */
    public function setTransactionAttributeValue(string $ref, array $attributesValue);

}