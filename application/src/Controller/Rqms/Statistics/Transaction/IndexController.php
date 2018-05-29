<?php

namespace App\Controller\Rqms\Statistics\Transaction;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Domain\Transaction\Service\TransactionServiceInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Domain\Transaction\Entity\Search\Request\SearchRequestEntity;

class IndexController extends AbstractController
{

    /**
     * @var TransactionServiceInterface
     */
    private $searchRequestService;

    /**
     * IndexController constructor.
     * @param TransactionServiceInterface $searchRequestService
     */
    public function __construct(TransactionServiceInterface $searchRequestService)
    {
        $this->searchRequestService = $searchRequestService;
    }

    /**
     * @Route("/api/rqms/statistics/transaction/v1/update/{reference}", name="transaction_update")
     * @return string
     */
    public function index(Request $request){
        $ref =$request->get('reference');
        $putData = fopen("php://input", "r");
        $attributes = json_decode(fread($putData, 8192), true);

        if (!$attributes || !$ref) {
            return new JsonResponse('An error occured, no data received or wrong formatting', JsonResponse::HTTP_BAD_REQUEST);
        }

        return $this->searchRequestService->setTransactionAttributeValue($ref, $attributes);

    }

}