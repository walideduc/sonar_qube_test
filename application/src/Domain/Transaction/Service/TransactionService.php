<?php

namespace App\Domain\Transaction\Service;

use App\Domain\Transaction\Dispatcher\TransactionEventDispatcherInterface;
use App\Domain\Transaction\Event\ConsolidatedTransactionCreatedEvent;
use App\Domain\Transaction\Repository\Exception\TransactionRepositoryException;
use App\Domain\Transaction\Repository\TransactionRepository;
use App\Domain\Transaction\Repository\TransactionRepositoryInterface;
use App\Domain\Transaction\Service\Exception\TransactionServiceException;
use Tsi\Transaction\Entity\TransactionEntityInterface;
use App\Domain\Transaction\Entity\Search\Request\SearchRequestEntityInterface;

class TransactionService implements TransactionServiceInterface
{
    /**
     * @var TransactionRepository
     */
    private $transactionRepository;

    /**
     * @var TransactionEventDispatcherInterface
     */
    private $transactionEventDispatcher;

    /**
     * TransactionService constructor.
     *
     * @param TransactionRepositoryInterface      $transactionRepository
     * @param TransactionEventDispatcherInterface $transactionEventDispatcher
     */
    public function __construct(
        TransactionRepositoryInterface $transactionRepository,
        TransactionEventDispatcherInterface $transactionEventDispatcher
    ) {
        $this->transactionRepository = $transactionRepository;
        $this->transactionEventDispatcher = $transactionEventDispatcher;

    }

    /**
     * @inheritdoc
     */
    public function createOrUpdateTransaction(
        TransactionEntityInterface $consolidatedTransactionEntity
    ): TransactionEntityInterface {
        try {
            $consolidatedTransactionEntity
                = $this->transactionRepository->save($consolidatedTransactionEntity);

            $this->transactionEventDispatcher->dispatch(
                ConsolidatedTransactionCreatedEvent::NAME,
                new ConsolidatedTransactionCreatedEvent($consolidatedTransactionEntity)
            );

            return $consolidatedTransactionEntity;
        } catch (TransactionRepositoryException $transactionRepositoryException) {
            throw TransactionServiceException::createFromTransactionRepositoryException(
                $transactionRepositoryException
            );
        }

    }

    public function searchTransaction(SearchRequestEntityInterface $searchRequestEntity)
    {
        return $this->transactionRepository->searchTransactions($searchRequestEntity);
    }

    /**
     * @param string $ref
     * @param array $attributesValue
     * @return TransactionEntityInterface
     */
    public function setTransactionAttributeValue(string $ref, array $attributesValue)
    {
        return $this->transactionRepository->setTransactionAttributeValue($ref, $attributesValue);
    }
}
