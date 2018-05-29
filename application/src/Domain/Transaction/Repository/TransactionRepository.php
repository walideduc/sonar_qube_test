<?php

namespace App\Domain\Transaction\Repository;

use App\Domain\Transaction\Repository\Exception\TransactionRepositoryException;
use App\Infrastructure\NoSqlDatabase\Collection\NoSqlDatabaseCollectionInterface;
use App\Infrastructure\NoSqlDatabase\Exception\NoSqlDatabaseException;
use MongoDB\BSON\UTCDateTime;
use DateTime;
use PHPUnit\Util\Json;
use Tsi\Transaction\Entity\TransactionEntityInterface;
use Tsi\Transaction\Hydrator\ConsolidatedTransaction\ConsolidatedTransactionHydratorInterface;
use App\Domain\Transaction\Entity\Search\Request\SearchRequestEntityInterface;
use MongoDB\BSON\ObjectId;
use Symfony\Component\HttpFoundation\JsonResponse;


/**
 * Class TransactionRepository
 *
 * @package App\Domain\Transaction\Repository
 */
final class TransactionRepository implements TransactionRepositoryInterface
{

    /**
     * @var ConsolidatedTransactionHydratorInterface
     */
    private $hydrator;


    /**
     * @var NoSqlDatabaseCollectionInterface
     */
    private $collection;

    /**
     * TransactionRepository constructor.
     *
     * @param ConsolidatedTransactionHydratorInterface $hydrator
     * @param NoSqlDatabaseCollectionInterface         $collection
     */
    public function __construct(
        ConsolidatedTransactionHydratorInterface $hydrator,
        NoSqlDatabaseCollectionInterface $collection
    ) {
        $this->hydrator = $hydrator;
        $this->collection = $collection;
    }

    /**
     * @inheritdoc
     */
    public function save(
        TransactionEntityInterface $transactionEntity
    ): TransactionEntityInterface
    {
        try {
            $transactionDocument
                = $this ->hydrator
                ->extract($transactionEntity);
            $transactionDocument['dt_creation'] = empty($transactionDocument['dt_creation']) ? null : New UTCDateTime(new DateTime($transactionDocument['dt_creation']));
            $this->collection->upsert(
                $transactionDocument,
                [
                    'reference' => $transactionEntity->getReference(),
                    'timestamp' => $transactionEntity->getTimestamp()
                ]
            );

            return $transactionEntity;
        }catch (NoSqlDatabaseException $noSqlDatabaseException){
            throw TransactionRepositoryException::createFromNoSqlDatabaseException(
                $noSqlDatabaseException
            );
        }
    }

    /**
     * @param string $ref
     * @param array $attributesValues
     * @return JsonResponse
     */
    public function setTransactionAttributeValue(string $ref, array $attributesValues)
    {
        try {
            $this->collection->updateMany(['reference' => $ref], ['$set' => $attributesValues]);
            return new JsonResponse(['success' => true]);
        } catch (\Exception $e) {
            return new JsonResponse(['success' => false, 'message' => $e->getMessage()], JsonResponse::HTTP_BAD_REQUEST);
        }

    }

    public function searchTransactions(SearchRequestEntityInterface $searchRequestEntity)
    {

        $request = [];
        if ($searchRequestEntity->getMinAmount()) {
            $request = [
                'amount' => [
                    '$gte' => $searchRequestEntity->getMinAmount(),
                ]
            ];
        }

        if ($searchRequestEntity->getMaxAmount()) {
            // if minAmount is setted, get it
            if (isset($request['amount']['$gte'])) {
                $request = [
                    'amount' => [
                        '$gte' => $searchRequestEntity->getMinAmount(),
                        '$lte' => $searchRequestEntity->getMaxAmount(),
                    ]
                ];
            } else {
                $request = [
                    'amount' => [
                        '$lte' => $searchRequestEntity->getMaxAmount(),
                    ]
                ];
            }
        }

        // override amount min/max amount to fixed amount
        if ($searchRequestEntity->getAmount()) {
            $request = ['amount' => $searchRequestEntity->getAmount()];
        }

        if ($searchRequestEntity->getReference()) {
            $request = array_merge($request, ['reference' => $searchRequestEntity->getReference()]);
        }

        if ($searchRequestEntity->getAfterDate()) {
            $request = [
                'timestamp' => [
                    '$gte' => $searchRequestEntity->getAfterDate()
                ]
            ];
        }

        if ($searchRequestEntity->getBeforeDate()) {
            // if dateAfter is setted, get it
            if (isset($request['timestamp']['$gte'])) {
                $request = [
                    'timestamp' => [
                        '$gte' => $searchRequestEntity->getAfterDate(),
                        '$lte' => $searchRequestEntity->getBeforeDate(),
                    ]
                ];
            } else {
                $request = [
                    'timestamp' => [
                        '$lte' => $searchRequestEntity->getBeforeDate(),
                    ]
                ];
            }
        }

        // override min/max dates
        if ($searchRequestEntity->getDate()) {
            $request = array_merge($request, ['timestamp' => $searchRequestEntity->getDate()]);
        }

        if ($searchRequestEntity->getCustomerId()) {
            $request = array_merge($request, ['customer.id' => $searchRequestEntity->getCustomerId()]);
        }

        if ($searchRequestEntity->getStatus()) {
            // status only works with product
            if($searchRequestEntity->getProductId()) {
                $request = array_merge($request, [
                    'status' => $searchRequestEntity->getStatus(),
                    'product.id' => $searchRequestEntity->getProductId()
                ]);
            }
        }

        /*
         * '_id': { $in: [ObjectId("5a68bf522ebcb739d7ca4c1f"), ObjectId("5a69d5852ebcb739d7cc7fc4")] }
         */
        if (!empty($searchRequestEntity->getIds())) {
            // gets Ids to array
            $jsonIds = json_decode($searchRequestEntity->getIds(), true);
            $ids = [];
            if ($jsonIds) {
                foreach ($jsonIds as $id) {
                    try {
                        $ids[] = new ObjectId($id);
                    } catch (\Exception $e) {
                        return new JsonResponse([
                            'error' => sprintf('Transaction %s is not formatted correctly', $id)
                        ], JsonResponse::HTTP_PRECONDITION_FAILED);
                    }
                }
                $request = ['_id' => ['$in' => $ids]];
            } else {
                $request = ['_id' => false];
            }
        }

        $options = [];

        if ($searchRequestEntity->getPage()) {
            $options = [
                'skip' => $searchRequestEntity->getPage()-1,
            ];
        }

        if ($searchRequestEntity->getPageSize()) {
            $options = array_merge( $options,[
                'limit' => $searchRequestEntity->getPageSize()
            ]);
        }

        $transactions = $this->collection->find($request, $options);
        // we get a cursor (pointer to the resulting collection)
        $trs = [];
        foreach($transactions as $transaction) {
            $trs[] = [
                'id' => $transaction->_id->__toString(),
                'reference' => $transaction->reference,
                'amount' => $transaction->amount,
                'currency' => $transaction->currency,
                'customer' => [
                    'email' => $transaction->customer->email,
                    'id' => $transaction->customer->id,
                    'origin' => $transaction->customer->origin
                ],
                'dt_creation' => date('Y-m-d H:i:s', $transaction->dt_creation->__toString() / 1000),
                'status' => $transaction->status
            ];
        }
        $result = new JsonResponse($trs);
        return $result;
    }
}
