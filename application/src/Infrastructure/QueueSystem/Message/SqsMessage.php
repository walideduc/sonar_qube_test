<?php

namespace App\Infrastructure\QueueSystem\Message;

use App\Infrastructure\QueueSystem\Message\Exception\AttributeNotFoundException;

final class SqsMessage implements MessageInterface
{
    const ATTRIBUTE_BODY = 'Body';

    const BODY_MESSAGE_ATTRIBUTE = 'Message';

    const ATTRIBUTE_RECEIPT_HANDLE = 'ReceiptHandle';

    /**
     * @var array
     */
    private $data;

    /**
     * Message constructor.
     *
     * @param array $data
     */
    private function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @inheritdoc
     */
    public static function createFromArray(
        array $data
    ): MessageInterface {
        return new static(
            $data
        );
    }

    /**
     * @inheritdoc
     */
    public function getBody(): string
    {
        return $this->getAttribute(static::ATTRIBUTE_BODY);
    }

    /**
     * @inheritdoc
     */
    public function getBodyAttribute(string $attributeName)
    {
        $body = json_decode($this->getBody());

        if (isset($body->{$attributeName})) {
            return json_decode($body->{$attributeName});
        }

        throw AttributeNotFoundException::fromAttributeName($attributeName);

    }

    /**
     * @inheritdoc
     */
    private function getAttribute(string $attributeName): string
    {
        if (array_key_exists($attributeName, $this->data)) {
            return $this->data[$attributeName];
        }

        throw AttributeNotFoundException::fromAttributeName($attributeName);
    }

    /**
     * @inheritdoc
     */
    public function getReceiptHandle(): string
    {
        return $this->getAttribute(static::ATTRIBUTE_RECEIPT_HANDLE);
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }
}
