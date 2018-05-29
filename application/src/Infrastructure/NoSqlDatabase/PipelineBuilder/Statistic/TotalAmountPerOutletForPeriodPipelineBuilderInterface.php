<?php
namespace App\Infrastructure\NoSqlDatabase\PipelineBuilder\Statistic;

interface TotalAmountPerOutletForPeriodPipelineBuilderInterface
{
    /**
     * @param string $type
     * @param int $outletId
     * @param int $minutes
     * @return array
     */
    public function build(string $type, int $outletId, int $minutes) : array ;
}