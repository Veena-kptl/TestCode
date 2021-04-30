<?php

namespace LoginRestriction\TaskModule\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use LoginRestriction\TaskModule\Api\Data\IpInterface;
use LoginRestriction\TaskModule\Api\Data\IpSearchResultsInterface;

interface IpRepositoryInterface
{
    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return ReviewSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria);

    /**
     * @param IpInterface $book
     * @return IpInterface
     * @throws LocalizedException
     */
    public function save(IpInterface $ip);

    /**
     * @param int $id
     * @return IpInterface
     * @throws LocalizedException
     */
    public function getById($id);

    /**
     * @param IpInterface $book
     * @return bool
     * @throws LocalizedException
     */
    public function delete(IpInterface $ip);

    /**
     * @param int $id
     * @return bool
     * @throws NoSuchEntityException
     * @throws LocalizedException
     */
    public function deleteById($id);



}
