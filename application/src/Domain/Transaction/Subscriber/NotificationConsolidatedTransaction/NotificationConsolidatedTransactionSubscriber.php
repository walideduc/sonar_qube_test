<?php

namespace App\Domain\Transaction\Subscriber\NotificationConsolidatedTransaction;

use App\Domain\Transaction\Event\ConsolidatedTransactionCreatedEventInterface;
use App\Domain\Transaction\Subscriber\NotificationConsolidatedTransaction\Exception\NotificationConsolidatedTransactionSubscriberException;
use App\Infrastructure\NotificationSystem\Client\ClientInterface;
use App\Infrastructure\NotificationSystem\Client\Exception\NotificationSystemException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Tsi\Transaction\Hydrator\ConsolidatedTransaction\ConsolidatedTransactionHydratorInterface;

class NotificationConsolidatedTransactionSubscriber
    implements EventSubscriberInterface
{

    /**
     * @var ClientInterface
     */
    private $notificationClient;

    /**
     * @var ConsolidatedTransactionHydratorInterface
     */
    private $transactionHydrator;

    public function __construct(
        ClientInterface $notificationClient,
        ConsolidatedTransactionHydratorInterface $transactionHydrator
    ) {
        $this->notificationClient = $notificationClient;
        $this->transactionHydrator = $transactionHydrator;
    }

    public function onConsolidatedTransactionCreated(
        ConsolidatedTransactionCreatedEventInterface $event
    ) {

        try {
            $this->notificationClient->publish(
                json_encode(
                    $this->transactionHydrator->extract(
                        $event->getConsolidatedTransactionEntity()
                    ))
            );
        } catch (NotificationSystemException $notificationSystemException) {
            throw NotificationConsolidatedTransactionSubscriberException::createFromNotificationSystemException(
                $notificationSystemException
            );
        }

    }

    public static function getSubscribedEvents()
    {
        return [
            ConsolidatedTransactionCreatedEventInterface::NAME => 'onConsolidatedTransactionCreated',
        ];
    }
}
