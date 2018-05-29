<?php
namespace App\Domain\Transaction\Service\Statistics\Outlets;

use App\Domain\Transaction\Entity\Outlet\Statistic\OutletStatisticEntity;
use App\Domain\Transaction\Repository\Statistics\Outlets\Exception\OutletNotFoundException as OutletNotFoundExceptionFromRepository;
use App\Domain\Transaction\Repository\Statistics\Outlets\OutletStatisticRepositoryInterface;
use App\Domain\Transaction\Service\Statistics\Outlets\Exception\OutletNotFoundException;

class OutletStatisticService implements OutletStatisticServiceInterface
{
    /**
     * @var OutletStatisticRepositoryInterface
     */
    private $outletStatisticRepository;

    /**
     * OutletStatisticService constructor.
     * @param OutletStatisticRepositoryInterface $outletStatisticRepository
     */
    public function __construct(OutletStatisticRepositoryInterface $outletStatisticRepository)
    {
        $this->outletStatisticRepository = $outletStatisticRepository;
    }

    /**
     * @inheritdoc
     */
    public function totalAmountPerOutletForPeriod($outletId, $minutes): OutletStatisticEntity
    {
        try{
            return $this->outletStatisticRepository->totalAmountPerOutletForPeriod($outletId,$minutes);
        }catch (OutletNotFoundExceptionFromRepository $outletNotFoundException){
            throw OutletNotFoundException::createFromOutletNotFoundExceptionFromRepository($outletNotFoundException);
        }
    }


}