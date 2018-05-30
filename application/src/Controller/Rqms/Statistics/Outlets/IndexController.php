<?php

namespace App\Controller\Rqms\Statistics\Outlets;

use App\Domain\Transaction\Service\Statistics\Outlets\Exception\OutletNotFoundException;
use App\Domain\Transaction\Service\Statistics\Outlets\OutletStatisticServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @var OutletStatisticServiceInterface
     */
    private $outletStatisticService;

    /**
     * IndexController constructor.
     * @param OutletStatisticServiceInterface $outletStatisticService
     */
    public function __construct(OutletStatisticServiceInterface $outletStatisticService)
    {
        $this->outletStatisticService = $outletStatisticService;
    }

    /**
     * @Route("/api/rqms/statistics/outlets/v1/{outletId}/period/{minutes}", name="outlet_statistics")
     */
    public function index(
        $outletId,
        $minutes
    ){
        try{
            $outletStatisticEntity = $this->outletStatisticService->totalAmountPerOutletForPeriod($outletId,$minutes);
            return new JsonRes
            );
        }catch (OutletNotFoundException $outletNotFoundException){
            return new JsonResponse(
                [
                    'error' => $outletNotFoundException->getMessage()
                ],
                404
            );
        }
    }
}