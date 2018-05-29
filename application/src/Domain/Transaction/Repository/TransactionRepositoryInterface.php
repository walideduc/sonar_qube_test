<?php

namespace App\Domain\Transaction\Repository;

use Tsi\Transaction\Entity\TransactionEntity;
use Tsi\Transaction\Entity\TransactionEntityInterface;
use App\Domain\Transaction\Entity\Search\Request\SearchRequestEntityInterface;

/**
 * Interface TransactionRepositoryInterface
 *
 * @package App\Domain\Transaction\Repository
 */
interface TransactionRepositoryInterface
{
    /**
     * @param TransactionEntityInterface $transactionEntity
     *
     * @return TransactionEntityInterface
     */
    public function save(TransactionEntityInterface $transactionEntity
    ): TransactionEntityInterface;

    /**
     * @param SearchRequestEntityInterface $searchRequestEntity
     * @return array
     */
    public function searchTransactions(SearchRequestEntityInterface $searchRequestEntity);

    /**
     * @param string $ref
     * @param array $attributesValues
     * @return TransactionEntity
     */
    public function setTransactionAttributeValue(string $ref, array $attributesValues);

}