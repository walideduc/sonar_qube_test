<?php

namespace App\Domain\Transaction\Subscriber\NotificationConsolidatedTransaction\Exception;

use App\Infrastructure\NotificationSystem\Client\Exception\NotificationSystemException;
use RuntimeException;
class NotificationConsolidatedTransactionSubscriberException extends RuntimeException
{

    public static function createFromNotificationSystemException(
        NotificationSystemException $notificationSystemException
    ){
        return new static(
            $notificationSystemException->getMessage(),
            $notificationSystemException->getCode()
        );
    }
}