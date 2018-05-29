<?php

namespace spec\App\Infrastructure\NotificationSystem\Client;

use App\Infrastructure\NotificationSystem\Client\SnsClient;
use Aws\Command;
use Aws\CommandInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Aws\Sns\SnsClient as AwsSnsClient;
use Aws\Exception\AwsException;

class SnsClientSpec extends ObjectBehavior
{
    function let(AwsSnsClient $snsClient){
        $this->beConstructedWith($snsClient, '');
    }

    function it_should_be_able_to_push_a_message(AwsSnsClient $snsClient){
        $this->publish(Argument::any());
        $snsClient->publish(Argument::any())->shouldBeCalled();
    }

    function it_should_be_able_to_throw_an_exception(AwsSnsClient $snsClient){
        $awsException = new AwsException(
            '',
            new Command('')
        );
        $snsClient
            ->publish(Argument::any())
            ->willThrow($awsException);

        $this
            ->shouldThrow('App\Infrastructure\NotificationSystem\Client\Exception\NotificationSystemException')
            ->duringPublish('message');

    }
}
