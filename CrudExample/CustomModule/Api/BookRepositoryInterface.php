<?php

namespace CrudExample\CustomModule\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use CrudExample\CustomModule\Api\Data\BookInterface;
use CrudExample\CustomModule\Api\Data\BookSearchResultsInterface;

interface BookRepositoryInterface
{
    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return ReviewSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria);

    /**
     * @param BookInterface $book
     * @return BookInterface
     * @throws LocalizedException
     */
    public function save(BookInterface $book);

    /**
     * @param int $id
     * @return BookInterface
     * @throws LocalizedException
     */
    public function getById($id);

    /**
     * @param BookInterface $book
     * @return bool
     * @throws LocalizedException
     */
    public function delete(BookInterface $book);

    /**
     * @param int $id
     * @return bool
     * @throws NoSuchEntityException
     * @throws LocalizedException
     */
    public function deleteById($id);



}
