<?php

namespace App\Controller\Rqms\Statistics\TPOnline;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{

    /**
     * @Route("/api/rqms/statistics/tp-online/customers/v1/{email}/period/{minutes}", name="tp_online_statistics")
     */
    public function index(
        $email,
        $minutes
    ){

        return new JsonResponse(
            [
                'data' =>
                    [
                        'amount' => 0,
                        'currency' => 'EUR',
                        'email' => $email,
                        'period' => $minutes
                    ]
            ]
        );
    }
}