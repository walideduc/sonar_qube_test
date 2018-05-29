<?php

namespace App\Infrastructure\NotificationSystem\Client\Exception;

use Aws\Exception\AwsException;
use RuntimeException;

class NotificationSystemException extends RuntimeException
{
    public static function createFromException(AwsException $awsException)
    {
        return new static(
            $awsException->getMessage(),
            $awsException->getCode()
        );
    }
}