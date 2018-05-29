<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private 'App\Domain\Transaction\Subscriber\NotificationConsolidatedTransaction\NotificationConsolidatedTransactionSubscriber' shared autowired service.

include_once $this->targetDirs[3].'/vendor/aws/aws-sdk-php/src/AwsClientInterface.php';
include_once $this->targetDirs[3].'/vendor/aws/aws-sdk-php/src/AwsClientTrait.php';
include_once $this->targetDirs[3].'/vendor/aws/aws-sdk-php/src/AwsClient.php';
include_once $this->targetDirs[3].'/vendor/aws/aws-sdk-php/src/Sns/SnsClient.php';
include_once $this->targetDirs[3].'/src/Infrastructure/NotificationSystem/Client/ClientInterface.php';
include_once $this->targetDirs[3].'/src/Infrastructure/NotificationSystem/Client/SnsClient.php';
include_once $this->targetDirs[3].'/src/Domain/Transaction/Subscriber/NotificationConsolidatedTransaction/NotificationConsolidatedTransactionSubscriber.php';

return $this->privates['App\Domain\Transaction\Subscriber\NotificationConsolidatedTransaction\NotificationConsolidatedTransactionSubscriber'] = new \App\Domain\Transaction\Subscriber\NotificationConsolidatedTransaction\NotificationConsolidatedTransactionSubscriber(new \App\Infrastructure\NotificationSystem\Client\SnsClient(new \Aws\Sns\SnsClient($this->getParameter('aws.config')), $this->getEnv('AWS_SNS_TOPIC')), ($this->privates['Tsi\Transaction\Hydrator\ConsolidatedTransaction\ConsolidatedTransactionHydratorInterface'] ?? $this->load(__DIR__.'/getConsolidatedTransactionHydratorInterfaceService.php')));
