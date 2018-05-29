<?php

namespace App\Controller\Rqms\Statistics\ItalyOutlets;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{

    /**
     * @Route("/api/rqms/statistics/italy-outlets/v1/{outletId}/period/{minutes}", name="italy_outlet_statistics")
     */
    public function index(
        $outletId,
        $minutes
    ){

        return new JsonResponse(
            [
                'data' =>
                    [
                        'amount' => 0,
                        'currency' => 'EUR',
                        'outlet_id' => $outletId,
                        'period' => $minutes
                    ]
            ]
        );
    }
}