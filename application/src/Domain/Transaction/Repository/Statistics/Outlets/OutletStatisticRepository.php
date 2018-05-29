<?php

namespace App\Domain\Transaction\Repository\Statistics\Outlets;

use App\Domain\Transaction\Entity\Outlet\Statistic\OutletStatisticEntity;
use App\Domain\Transaction\Repository\Statistics\Outlets\Exception\OutletNotFoundException;
use App\Infrastructure\NoSqlDatabase\Collection\NoSqlDatabaseCollectionInterface;
use App\Infrastructure\NoSqlDatabase\PipelineBuilder\Statistic\TotalAmountPerOutletForPeriodPipelineBuilderInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class OutletStatisticRepository implements OutletStatisticRepositoryInterface
{
    /**
     * @var NoSqlDatabaseCollectionInterface
     */
    private $collection;
    /**
     * @var TotalAmountPerOutletForPeriodPipelineBuilderInterface
     */
    private $totalAmountPerOutletForPeriodPipelineBuilder;

    /**
     * OutletStatisticRepository constructor.
     * @param NoSqlDatabaseCollectionInterface $collection
     * @param TotalAmountPerOutletForPeriodPipelineBuilderInterface $totalAmountPerOutletForPeriodPipelineBuilder
     */
    public function __construct(NoSqlDatabaseCollectionInterface $collection, TotalAmountPerOutletForPeriodPipelineBuilderInterface $totalAmountPerOutletForPeriodPipelineBuilder)
    {
        $this->collection = $collection;
        $this->totalAmountPerOutletForPeriodPipelineBuilder = $totalAmountPerOutletForPeriodPipelineBuilder;
    }


    /**
     * @inheritdoc
     */
    public function totalAmountPerOutletForPeriod(int $outletId, int $minutes): OutletStatisticEntity
    {
        $outlet = $this->collection->findOne([
            'outlet.id' => "$outletId"
        ]);
        if(is_null($outlet)){
            Throw New OutletNotFoundException('Outlet Not found');
        }

        $pipeline = $this->totalAmountPerOutletForPeriodPipelineBuilder->build('POD',$outletId,$minutes);

        $result = $this->collection->aggregate($pipeline);
        /**
         * @var \MongoDB\Model\BSONDocument $BSONDocument
         */

        $BSONDocument = ($result->toArray()[0]) ?? null;

        $totalAmount = 0;
        if($BSONDocument){
            $arrayCopy = $BSONDocument->getArrayCopy();
            $totalAmount = $arrayCopy['total_amount'];
        }

        $outletStatisticEntity = New OutletStatisticEntity(
            $outletId,
            $totalAmount,
            $minutes
        );

        return $outletStatisticEntity;

    }


}