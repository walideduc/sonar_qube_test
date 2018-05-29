<?php

namespace App\Controller\Rqms\Statistics\Search;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Domain\Transaction\Service\TransactionServiceInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Domain\Transaction\Entity\Search\Request\SearchRequestEntity;

class IndexController extends AbstractController
{

    const NOT_FOUND = 404;
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
     * @Route("/api/rqms/statistics/search/v1/query/", name="search_filter")
     */
    public function index(Request $request){
        // get all parameters from query string
        $queryArray =$request->query->all();
        $searchRequest = new SearchRequestEntity();

        foreach ($queryArray as $property => $value) {
            $setter = 'set' . ucfirst($property);
            if (method_exists($searchRequest, $setter)) {
                $searchRequest->$setter($value);
            }
        }

        $transactions = $this->searchRequestService->searchTransaction($searchRequest);
        return $transactions;
    }

    /**
     * @Route("/api/rqms/statistics/search/v1/subset/", name="search_subset")
     */
    public function subset(Request $request){
        // get the posted Ids
        $queryArray =$request->get('ids');
        $searchRequest = new SearchRequestEntity();
        $searchRequest->setIds($queryArray);
        if (empty($searchRequest->getIds())) {
            return new JsonResponse(
                [
                    'error' => sprintf('No transaction found')
                ],
                self::NOT_FOUND
            );
        }

        $transactions = $this->searchRequestService->searchTransaction($searchRequest);

        // JsonResponse
        return $transactions;
    }
}