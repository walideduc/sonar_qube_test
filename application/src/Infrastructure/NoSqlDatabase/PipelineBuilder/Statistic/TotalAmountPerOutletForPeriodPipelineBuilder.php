<?php

namespace App\Infrastructure\NoSqlDatabase\PipelineBuilder\Statistic;

use MongoDB\BSON\UTCDateTime;
use DateTime;
use DateInterval;

class TotalAmountPerOutletForPeriodPipelineBuilder
    implements TotalAmountPerOutletForPeriodPipelineBuilderInterface
{
    public function build(string $type, int $outletId, int $minutes): array
    {

        $dateTime = new DateTime();
        $dateTime->sub(new DateInterval('PT' . $minutes . 'M'));

        $stage1 = [
            '$match' => [
                'type'        => $type,
                'outlet.id'   => (string)$outletId,
                'dt_creation' => [
                    '$gte' => new UTCDateTime($dateTime)
                ]
            ]
        ];

        $stage2 = [
            '$group' => [
                '_id'    => [
                    'reference' => '$reference',
                    'amount'    => '$amount',
                    'outlet'    => '$outlet.id'
                ],
                'amount' =>
                    [
                        '$max' => '$amount'
                    ]
            ]
        ];

        $stage3 = [
            '$group' => [
                '_id'          => '$_id.outlet',
                'total_amount' => ['$sum' => '$amount']
            ]
        ];

        $pipeline = [
            $stage1,
            $stage2,
            $stage3
        ];

        return $pipeline;
    }

}