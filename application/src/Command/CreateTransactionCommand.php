<?php

namespace App\Command;

use App\Domain\Action\FetchRawTransactions\FetchRawTransactionsInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateTransactionCommand extends Command
{
    /**
     * @var FetchRawTransactionsInterface
     */
    private $fetchRawTransactions;


    public function __construct(
        FetchRawTransactionsInterface $fetchRawTransactions
    ) {
        parent::__construct();
        $this->fetchRawTransactions = $fetchRawTransactions;
    }

    protected function configure()
    {
        $this
            ->setName('tsi:transactions')
            ->setDescription('Create consolidated transaction data')
            ->setHelp('This command allows you to create consolidated transaction data');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->wr

        $fetchRawTransactionsResponse = $this->fetchRawTransactions
            ->fetch();

        $output->writeln(
            json_encode(
                [
                    'application' => 'transaction-service',
                    'message'     => $fetchRawTransactionsResponse->toArray()
                ]
            ));
    }
}