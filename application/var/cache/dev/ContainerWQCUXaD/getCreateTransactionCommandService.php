<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the public 'console.command.public_alias.App\Command\CreateTransactionCommand' shared autowired service.

include_once $this->targetDirs[3].'/vendor/aws/aws-sdk-php/src/AwsClientInterface.php';
include_once $this->targetDirs[3].'/vendor/aws/aws-sdk-php/src/AwsClientTrait.php';
include_once $this->targetDirs[3].'/vendor/aws/aws-sdk-php/src/AwsClient.php';
include_once $this->targetDirs[3].'/vendor/aws/aws-sdk-php/src/Sqs/SqsClient.php';
include_once $this->targetDirs[3].'/src/Infrastructure/QueueSystem/Client/ClientInterface.php';
include_once $this->targetDirs[3].'/src/Infrastructure/QueueSystem/Client/SqsClient.php';
include_once $this->targetDirs[3].'/src/Domain/Transaction/Event/TransactionCreatedEvent/Collection/TransactionCreatedEventCollectionInterface.php';
include_once $this->targetDirs[3].'/vendor/dgifford/iterator-trait/src/IteratorTrait.php';
include_once $this->targetDirs[3].'/src/Domain/Transaction/Event/TransactionCreatedEvent/Collection/TransactionCreatedEventCollection.php';
include_once $this->targetDirs[3].'/src/Domain/Action/FetchRawTransactions/FetchRawTransactionsInterface.php';
include_once $this->targetDirs[3].'/src/Domain/Action/FetchRawTransactions/FetchRawTransactions.php';
include_once $this->targetDirs[3].'/vendor/symfony/console/Command/Command.php';
include_once $this->targetDirs[3].'/src/Command/CreateTransactionCommand.php';

return $this->services['console.command.public_alias.App\Command\CreateTransactionCommand'] = new \App\Command\CreateTransactionCommand(new \App\Domain\Action\FetchRawTransactions\FetchRawTransactions(new \App\Infrastructure\QueueSystem\Client\SqsClient(new \Aws\Sqs\SqsClient($this->getParameter('aws.config')), $this->getEnv('AWS_SQS_QUEUE')), ($this->privates['App\Domain\Transaction\Dispatcher\TransactionEventDispatcherInterface'] ?? $this->load(__DIR__.'/getTransactionEventDispatcherInterfaceService.php')), new \App\Domain\Transaction\Event\TransactionCreatedEvent\Collection\TransactionCreatedEventCollection()));
