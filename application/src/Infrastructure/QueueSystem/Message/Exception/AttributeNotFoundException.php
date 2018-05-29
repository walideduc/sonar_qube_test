<?php

namespace App\Infrastructure\QueueSystem\Message\Exception;

use LogicException;

/**
 * Class AttributeNotFoundException
 *
 * @package Tsi\Lab\QueueSystem\Message\Exception
 */
class AttributeNotFoundException extends LogicException
{
    /**
     * @param string $attributeName
     *
     * @return AttributeNotFoundException
     */
    public static function fromAttributeName(
        string $attributeName
    ): self {
        return new static(
            sprintf('%s not found', $attributeName)
        );
    }
}
