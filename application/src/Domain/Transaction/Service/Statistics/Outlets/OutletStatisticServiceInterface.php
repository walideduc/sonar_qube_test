<?php
/**
 * Created by PhpStorm.
 * User: waled
 * Date: 11/01/2018
 * Time: 17:11
 */

namespace App\Domain\Transaction\Service\Statistics\Outlets;


use App\Domain\Transaction\Entity\Outlet\Statistic\OutletStatisticEntity;
use App\Domain\Transaction\Service\Statistics\Outlets\Response\TotalAmountPerOutletForPeriodResponse;

/**
 * Interface OutletStatisticServiceInterface
 * @package App\Domain\Transaction\Service\Statistics\Outlets
 */
interface OutletStatisticServiceInterface
{

    /**
     * @param $outletId
     * @param $minutes
     * @return OutletStatisticEntity
     */
    public function totalAmountPerOutletForPeriod($outletId, $minutes) : OutletStatisticEntity;
}