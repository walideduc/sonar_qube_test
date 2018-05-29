<?php

namespace App\Infrastructure\QueueSystem\Client\Exception;
use Aws\Exception\AwsException;
use RuntimeException;

class QueueSystemException extends RuntimeException
{
    /**
     * @param AwsException $awsException
     *
     * @return static
     */
    public static function fromAwsException(
        AwsException $awsException
    ): self {
        return new static(
            $awsException->getMessage(),
            $awsException->getCode()
        );
    }
}