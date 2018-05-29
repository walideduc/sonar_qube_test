<?php

namespace App\Domain\Action\FetchRawTransactions;


use App\Domain\Action\FetchRawTransactions\FetchRawTransactionsResponse\FetchRawTransactionsResponseInterface;

/**
 * Interface FetchRawTransactionsInterface
 *
 * @package App\Domain\Action\FetchRawTransactions
 */
interface FetchRawTransactionsInterface
{

    /**
     * @return FetchRawTransactionsResponseInterface
     */
    public function fetch(): FetchRawTransactionsResponseInterface;

}