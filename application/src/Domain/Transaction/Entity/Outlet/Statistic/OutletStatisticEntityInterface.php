<?php
/**
 * Created by PhpStorm.
 * User: waled
 * Date: 13/01/2018
 * Time: 13:21
 */

namespace App\Domain\Transaction\Entity\Outlet\Statistic;


interface OutletStatisticEntityInterface
{
    /**
     * @return int
     */
    public function getAmount(): int;

    /**
     * @return string
     */
    public function getCurrency(): string ;

    /**
     * @return int
     */
    public function getOutletId(): int;

    /**
     * @return int
     */
    public function getPeriodInMinutes(): int;
}