<?php

namespace App\Infrastructure\NotificationSystem\Client;

use App\Infrastructure\NotificationSystem\Client\Exception\NotificationSystemException;
use Aws\Exception\AwsException;
use Aws\Sns\SnsClient as AwsSnsClient;

class SnsClient implements ClientInterface
{

    /**
     * @var AwsSnsClient
     */
    private $snsClient;

    /**
     * @var string
     */
    private $topicUrl;

    /**
     * SnsClient constructor.
     * @param AwsSnsClient $snsClient
     * @param $topicUrl
     */
    public function __construct(AwsSnsClient $snsClient,  string $topicUrl)
    {
        $this->snsClient = $snsClient ;
        $this->topicUrl = $topicUrl;
    }

    public function publish(string $message): void
    {
        try{
            $return = $this->snsClient->publish(array(
                'TopicArn' => $this->topicUrl,
                'Message' => $message,
                'Subject' => 'Consolidated transaction'
            ));
        }catch (AwsException $exception){
            throw NotificationSystemException::createFromException($exception);
        }
    }
}