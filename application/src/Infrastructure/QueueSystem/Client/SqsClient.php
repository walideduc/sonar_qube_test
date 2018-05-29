<?php

namespace App\Infrastructure\QueueSystem\Client;

use App\Infrastructure\QueueSystem\Client\Exception\QueueSystemException;
use App\Infrastructure\QueueSystem\Message\SqsMessage;
use Aws\Exception\AwsException;
use Aws\Sqs\SqsClient as AwsSqsClient;


final class SqsClient implements ClientInterface
{
    /**
     * @var AwsSqsClient
     */
    private $sqsClient;

    /**
     * @var string
     */
    private $queueUrl;

    /**
     * SqsClient constructor.
     *
     * @param AwsSqsClient $sqsClient
     * @param string       $queueUrl
     */
    public function __construct(
        AwsSqsClient $sqsClient,
        string $queueUrl
    ) {
        $this->sqsClient = $sqsClient;
        $this->queueUrl = $queueUrl;
    }

    public function receive(): array
    {
        try {
            $result = $this->sqsClient->receiveMessage([
                 'QueueUrl' => $this->queueUrl,
            ]);

            $messageCollection = [];

            if ($result["Messages"] != null) {
                foreach ($result['Messages'] as $message) {
                    $messageCollection[] = SqsMessage::createFromArray($message);
                }
            }
        } catch (AwsException $awsException) {
            throw QueueSystemException::fromAwsException($awsException);
        }
        return $messageCollection;
    }

    public function consume(string $receiptHandle): void
    {
        try {
            $this->sqsClient->deleteMessage([
                'QueueUrl'      => $this->queueUrl,
                'ReceiptHandle' => $receiptHandle
            ]);
        } catch (AwsException $awsException) {
            throw QueueSystemException::fromAwsException($awsException);
        }
    }
}
