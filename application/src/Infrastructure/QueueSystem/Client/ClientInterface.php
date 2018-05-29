<?php

namespace App\Infrastructure\QueueSystem\Client;

interface ClientInterface
{
    /**
     * @return array
     */
    public function receive(): array;

    /**
     * @param string $receiptHandle
     */
    public function consume(string $receiptHandle): void;
}