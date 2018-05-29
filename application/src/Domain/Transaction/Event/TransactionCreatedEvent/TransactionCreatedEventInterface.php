<?php

namespace App\Domain\Transaction\Event\TransactionCreatedEvent;

use stdClass;
/**
 * Interface TransactionCreatedEventInterface
 *
 * @package App\Domain\Transaction\Event
 */
interface TransactionCreatedEventInterface
{
    const NAME = 'transaction.created';


    /**
     * @return stdClass
     */
    public function getTransaction(): stdClass;

    /**
     * @return mixed
     */
    public function stopPropagation();

    /**
     * @param bool $isMessageProcessed
     */
    public function setIsMessageProcessed(bool $isMessageProcessed): void;

    /**
     * @return bool
     */
    public function isMessageProcessed(): bool;

    /**
     * @param $consolidatedMessage
     *
     * @return array
     */
    public function setConsolidatedMessage(array $consolidatedMessage);

    /**
     * @return array
     */
    public function toArray(): array;


}