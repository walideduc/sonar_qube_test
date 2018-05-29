<?php
namespace  App\Domain\Transaction\Entity\Outlet\Statistic;

class OutletStatisticEntity implements OutletStatisticEntityInterface
{
    /**
     * @var int
     */
    private $outletId;
    /**
     * @var int
     */
    private $amount;

    /**
     * @var string
     */
    private $currency = 'EUR';

    /**
     * @var int
     */
    private $periodInMinutes;

    /**
     * OutletStatisticEntity constructor.
     * @param int $outletId
     * @param int $amount
     * @param int $periodInMinutes
     */
    public function __construct(int $outletId, int $amount, int $periodInMinutes)
    {
        $this->outletId = $outletId;
        $this->amount = $amount;
        $this->periodInMinutes = $periodInMinutes;
    }

    /**
     * @inheritdoc
     */
    public function getAmount(): int
    {
        return $this->amount;
    }
    /**
     * @inheritdoc
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @inheritdoc
     */
    public function getOutletId(): int
    {
        return $this->outletId;
    }
    /**
     * @inheritdoc
     */
    public function getPeriodInMinutes(): int
    {
        return $this->periodInMinutes;
    }
}