<?php

namespace App\Infrastructure\QueueSystem\Message;

/**
 * Interface MessageInterface
 *
 * @package Tsi\Lab\QueueSystem\Message
 */
interface MessageInterface
{

    /**
     * @param array $data
     *
     * @return MessageInterface
     */
    public static function createFromArray(array $data): MessageInterface;

    /**
     * @return string
     */
    public function getBody(): string;

    /**
     * @return string
     */
    public function getReceiptHandle(): string;

    /**
     * @return array
     */
    public function getData() : array ;


    /**
     * @param string $attributeName
     *
     * @return mixed
     */
    public function getBodyAttribute(string $attributeName);


}
