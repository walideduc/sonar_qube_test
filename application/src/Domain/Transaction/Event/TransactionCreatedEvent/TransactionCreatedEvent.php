<?php

namespace App\Domain\Transaction\Event\TransactionCreatedEvent;

use App\Infrastructure\QueueSystem\Message\SqsMessage;
use Symfony\Component\EventDispatcher\Event;
use stdClass;

/**
 * Class TransactionCreatedEvent
 *
 * @package App\Domain\Transaction\Event
 */
class TransactionCreatedEvent extends Event
    implements TransactionCreatedEventInterface
{
    /**
     * @var bool
     */
    private $isMessageProcessed = false;

    /**
     * @var SqsMessage
     */
    private $sqsMessage;

    /**
     * @var array
     */
    private $consolidatedMessage;

    /**
     * TransactionCreatedEvent constructor.
     *
     * @param SqsMessage $sqsMessage
     */
    public function __construct(SqsMessage $sqsMessage)
    {
        $this->sqsMessage = $sqsMessage;
    }

    /**
     * @inheritdoc
     */
    public function getTransaction(): stdClass
    {
        return $this->sqsMessage->getBodyAttribute(
            SqsMessage::BODY_MESSAGE_ATTRIBUTE
        );
    }

    /**
     * @param bool $isMessageProcessed
     */
    public function setIsMessageProcessed(bool $isMessageProcessed): void
    {
        $this->isMessageProcessed = $isMessageProcessed;
    }

    /**
     * @return bool
     */
    public function isMessageProcessed(): bool
    {
        return $this->isMessageProcessed;
    }


    /**
     * @inheritdoc
     */
    public function setConsolidatedMessage(array $consolidatedMessage)
    {
        $this->consolidatedMessage = $consolidatedMessage;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {

        return [
            'rawMessage'          => $this->sqsMessage->getData(),
            'consolidatedMessage' => $this->consolidatedMessage
        ];

    }
}