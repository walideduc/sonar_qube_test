<?php

namespace App\Domain\Transaction\Subscriber\CreateConsolidatedTransaction;


use App\Domain\Transaction\Event\TransactionCreatedEvent\TransactionCreatedEventInterface;
use App\Domain\Transaction\Service\Exception\TransactionServiceException;
use App\Domain\Transaction\Service\TransactionServiceInterface;
use App\Domain\Transaction\Subscriber\CreateConsolidatedTransaction\Exception\CreateConsolidatedTransactionSubscriberException;
use App\Domain\Utility\Validator\Exception\InvalidDataException;
use App\Domain\Utility\Validator\ValidatorInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Tsi\Transaction\Hydrator\ConsolidatedTransaction\ConsolidatedTransactionHydratorInterface;

/**
 * Class CreateConsolidatedTransaction
 *
 * @package App\Domain\Transaction\Subscriber\CreateConsolidatedTransaction
 */
class CreateConsolidatedTransactionSubscriber
    implements EventSubscriberInterface
{
    /**
     * @var ValidatorInterface
     */
    private $validator;
    /**
     * @var ConsolidatedTransactionHydratorInterface
     */
    private $consolidatedTransactionHydrator;
    /**
     * @var TransactionServiceInterface
     */
    private $transactionService;

    /**
     * CreateConsolidatedTransaction constructor.
     *
     * @param ValidatorInterface                       $validator
     * @param ConsolidatedTransactionHydratorInterface $consolidatedTransactionHydrator
     * @param TransactionServiceInterface              $transactionService
     */
    public function __construct(
        ValidatorInterface $validator,
        ConsolidatedTransactionHydratorInterface $consolidatedTransactionHydrator,
        TransactionServiceInterface $transactionService
    ) {
        $this->validator = $validator;
        $this->consolidatedTransactionHydrator
            = $consolidatedTransactionHydrator;
        $this->transactionService = $transactionService;
    }


    public static function getSubscribedEvents()
    {
        return array(
            TransactionCreatedEventInterface::NAME => array(
                'onCreateAction',
                100
            ),
        );
    }

    public function onCreateAction(TransactionCreatedEventInterface $event)
    {
        try {
            $this->validator->validate(
                $event->getTransaction()
            );

            $transaction = $this
                ->consolidatedTransactionHydrator
                ->hydrate($event->getTransaction());

            $transaction = $this
                ->transactionService
                ->createOrUpdateTransaction($transaction);

            $event
                ->setIsMessageProcessed(true);

            $event
                ->setConsolidatedMessage($this
                    ->consolidatedTransactionHydrator
                    ->extract($transaction)
                );


        } catch (InvalidDataException $exception) {
            foreach ($exception->getErrors() as $error) {
                echo sprintf("[%s] %s\n", $error['property'],
                    $error['message']);
            }
        } catch (TransactionServiceException $transactionServiceException) {
            throw CreateConsolidatedTransactionSubscriberException::createFromTransactionServiceException(
                $transactionServiceException
            );
        }
    }
}