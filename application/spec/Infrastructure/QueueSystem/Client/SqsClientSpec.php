<?php

namespace spec\App\Infrastructure\QueueSystem\Client;

use App\Infrastructure\QueueSystem\Message\MessageInterface;
use Aws\Command;
use Aws\Exception\AwsException;
use Aws\Sqs\SqsClient as AwsSqsClient;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use App\Infrastructure\QueueSystem\Client\Exception\QueueSystemException;

class SqsClientSpec extends ObjectBehavior
{
    public function let(
        AwsSqsClient $awsSqsClient
    ) {
        $this->beConstructedWith(
            $awsSqsClient,
            ''
        );
    }

    public function it_returns_a_collection_of_sqs_messages_if_messages_exist_in_the_queue_when_receiving_messages(
        AwsSqsClient $awsSqsClient
    ) {
        $messages = [
            'Messages' => [
                [
                    'MessageId'     => '',
                    'ReceiptHandle' => '',
                    'Body'          => ''
                ]
            ]
        ];

        $awsSqsClient
            ->receiveMessage(Argument::any())
            ->willReturn($messages);

         $this
            ->receive()
             ->shouldBeACollectionOf(MessageInterface::class);
    }

    public function it_throws_a_queue_system_exception_when_there_is_an_aws_exception_when_receiving_messages(
        AwsSqsClient $awsSqsClient
    ) {
        $awsException = new AwsException(
            '',
            new Command('')
        );

        $awsSqsClient
            ->receiveMessage(Argument::any())
            ->willThrow($awsException);

        $this
            ->shouldThrow(QueueSystemException::class)
            ->duringReceive();
    }

    public function it_throws_a_queue_system_exception_if_there_is_an_aws_exception_when_deleting_messages(
        AwsSqsClient $awsSqsClient
    ) {
        $awsException = new AwsException(
            '',
            new Command('')
        );

        $awsSqsClient
            ->deleteMessage(Argument::any())
            ->willThrow($awsException);

        $this
            ->shouldThrow(QueueSystemException::class)
            ->duringConsume(Argument::any());
    }


    public function getMatchers(): array
    {
        return [
            "beACollectionOf" => function ($collection, $type) {
                if (count($collection) < 1) {
                    return false;
                }

                foreach ($collection as $item) {
                    if (!$item instanceof $type) {
                        return false;
                    }
                }

                return true;
            }
        ];
    }
}