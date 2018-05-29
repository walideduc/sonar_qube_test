<?php

namespace App\Domain\Transaction\Repository\Statistics\Outlets;


use App\Domain\Transaction\Entity\Outlet\Statistic\OutletStatisticEntity;

interface OutletStatisticRepositoryInterface
{
    /**
     * @param $outletId int
     * @param $minutes int
     * @return OutletStatisticEntity
     */
    public function totalAmountPerOutletForPeriod(int $outletId, int $minutes) : OutletStatisticEntity;
}