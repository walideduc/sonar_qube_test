<?php
namespace  App\Domain\Transaction\Entity\Search\Request;

class SearchRequestEntity implements SearchRequestEntityInterface
{
    /**
     * @var string
     */
    private $reference;
    /**
     * @var int
     */
    private $amount;
    /**
     * @var int
     */
    private $minAmount;
    /**
     * @var int
     */
    private $maxAmount;
    /**
     * @var string
     */
    private $productId;
    /**
     * @var string
     */
    private $status;
    /**
     * @var string
     */
    private $customerId;

    /**
     * @var string
     */
    private $date;

    /**
     * @var string
     */
    private $beforeDate;

    /**
     * @var string
     */
    private $afterDate;

    /**
     * @var int
     */
    private $page = 0;

    /**
     * @var int
     */
    private $pageSize = 100;

    /**
     * @var string
     */
    private $ids = [];

    /**
     * @return array
     */
    public function getIds()
    {
        return $this->ids;
    }

    /**
     * @param array $ids
     */
    public function setIds(array $ids)
    {
        $this->ids = $ids;
    }

    /**
     * @return int
     */
    public function getPage(): int
    {
        return $this->page;
    }

    /**
     * @param int $page
     */
    public function setPage(int $page)
    {
        $this->page = $page;
    }

    /**
     * @return int
     */
    public function getPageSize(): int
    {
        return $this->pageSize;
    }

    /**
     * @param int $pageSize
     */
    public function setPageSize(int $pageSize)
    {
        $this->pageSize = $pageSize;
    }


    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate(string $date)
    {
        // date must be formatted YYYY-mm-dd HH:ii:ss
        $this->date = strtotime($date);
    }

    /**
     * @return mixed
     */
    public function getBeforeDate()
    {
        return $this->beforeDate;
    }

    /**
     * @param string $date
     */
    public function setBeforeDate(string $date)
    {
        $this->beforeDate =strtotime($date);
    }

    /**
     * @return mixed
     */
    public function getAfterDate()
    {
        return $this->afterDate;
    }

    /**
     * @param string $date
     */
    public function setAfterDate(string $date)
    {
        $this->afterDate = strtotime($date);
    }

    /**
     * @return string|null
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @param string $reference
     */
    public function setReference(string $reference)
    {
        $this->reference = $reference;
    }

    /**
     * @return int|null
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param int $amount
     */
    public function setAmount(int $amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return int|null
     */
    public function getMinAmount()
    {
        return $this->minAmount;
    }

    /**
     * @param int $minAmount
     */
    public function setMinAmount(int $minAmount)
    {
        $this->minAmount = $minAmount;
    }

    /**
     * @return int|null
     */
    public function getMaxAmount()
    {
        return $this->maxAmount;
    }

    /**
     * @param int $maxAmount
     */
    public function setMaxAmount(int $maxAmount)
    {
        $this->maxAmount = $maxAmount;
    }

    /**
     * @return int|null
     */
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * @param string $productId
     */
    public function setProductId(string $productId)
    {
        $this->productId = $productId;
    }

    /**
     * @return string|null
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status)
    {
        $this->status = $status;
    }

    /**
     * @return int|null
     */
    public function getCustomerId()
    {
        return $this->customerId;
    }

    /**
     * @param string $customerId
     */
    public function setCustomerId(string $customerId)
    {
        $this->customerId = $customerId;
    }


}