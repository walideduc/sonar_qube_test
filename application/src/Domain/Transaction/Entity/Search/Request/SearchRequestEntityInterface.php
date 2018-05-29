<?php
/**
 * Created by PhpStorm.
 * User: waled
 * Date: 13/01/2018
 * Time: 13:21
 */

namespace App\Domain\Transaction\Entity\Search\Request;

interface SearchRequestEntityInterface
{

    /**
     * @param array $ids
     */
    public function setIds(array $ids);

    /**
     * @return array
     */
    public function getIds();
    /**
     * @return string|null
     */
    public function getReference();

    /**
     * @param string $reference
     */
    public function setReference(string $reference);

    /**
     * @return int|null
     */
    public function getAmount();

    /**
     * @param int $amount
     */
    public function setAmount(int $amount);

    /**
     * @return int|null
     */
    public function getMinAmount();

    /**
     * @param int $minAmount
     */
    public function setMinAmount(int $minAmount);

    /**
     * @return int|null
     */
    public function getMaxAmount();

    /**
     * @param int $maxAmount
     */
    public function setMaxAmount(int $maxAmount);

    /**
     * @return string|null
     */
    public function getProductId();

    /**
     * @param string $productId
     */
    public function setProductId(string $productId);

    /**
     * @return string|null
     */
    public function getStatus();

    /**
     * @param string $status
     */
    public function setStatus(string $status);

    /**
     * @return string|null
     */
    public function getCustomerId();

    /**
     * @param string $customerId
     */
    public function setCustomerId(string $customerId);

    /**
     * @param string
     */
    public function setDate(string $date);

    /**
     * @param string $date
     */
    public function setBeforeDate(string $date);


    /**
     * @return int
     */
    public function getPage();

    /**
     * @param int $page
     */
    public function setPage(int $page);

    /**
     * @return int
     */
    public function getPageSize();

    /**
     * @param int $pageSize
     */
    public function setPageSize(int $pageSize);


    /**
     * @param string $date
     */
    public function setAfterDate(string $date);

    /**
     * @return mixed
     */
    public function getDate();

    /**
     * @return mixed
     */
    public function getBeforeDate();

    /**
     * @return mixed
     */
    public function getAfterDate();

}