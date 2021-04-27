<?php

namespace CrudExample\CustomModule\Model\Repository;

use Exception;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\StateException;
use Magento\Framework\Model\AbstractModel;
use CrudExample\CustomModule\Api\Data\BookInterface;
use CrudExample\CustomModule\Api\Data\BookSearchResultsInterface;
use CrudExample\CustomModule\Api\Data\BookSearchResultsInterfaceFactory as SearchResultFactory;
use CrudExample\CustomModule\Api\BookRepositoryInterface;
use CrudExample\CustomModule\Model\ResourceModel\Book\Collection;
use CrudExample\CustomModule\Model\BookFactory as BookFactory;
use CrudExample\CustomModule\Model\ResourceModel\Book\CollectionFactory;
use CrudExample\CustomModule\Model\ResourceModel\Book as BookResource;

class BookRepository implements BookRepositoryInterface
{
    /**
     * @var array
     */
    protected $instances = [];

    /**
     * @var SearchResultFactory
     */
    private $searchResultFactory;

    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    /**
     * @var JoinProcessorInterface
     */
    private $joinProcessor;

    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;

    /**
     * @var BookFactory
     */
    private $BookFactory;

    /**
     * @var BookResource
     */
    private $BookResource;

    /**
     * @param SearchResultFactory $searchResultFactory
     * @param CollectionFactory $collectionFactory
     * @param JoinProcessorInterface $joinProcessor
     * @param CollectionProcessorInterface $collectionProcessor
     * @param BookFactory $BookFactory
     * @param BookResource $BookResource
     */
    public function __construct(
        SearchResultFactory $searchResultFactory,
        CollectionFactory $collectionFactory,
        JoinProcessorInterface $joinProcessor,
        CollectionProcessorInterface $collectionProcessor,
        BookFactory $BookFactory,
        BookResource $BookResource
    ) {
        $this->searchResultFactory = $searchResultFactory;
        $this->collectionFactory = $collectionFactory;
        $this->joinProcessor = $joinProcessor;
        $this->collectionProcessor = $collectionProcessor;
        $this->BookFactory = $BookFactory;
        $this->BookResource = $BookResource;
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return BookSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        /** @var BookSearchResultsInterface $searchResult */
        $searchResult = $this->searchResultFactory->create();

        /** @var Collection $collection */
        $collection = $this->collectionFactory->create();
        $this->joinProcessor->process($collection, BookInterface::class);
        $this->collectionProcessor->process($searchCriteria, $collection);
        $searchResult->setSearchCriteria($searchCriteria);
        $searchResult->setTotalCount($collection->getSize());
        $searchResult->setItems($collection->getItems());

        return $searchResult;
    }

    /**
     * @param BookInterface $Book
     * @return BookInterface
     * @throws LocalizedException
     */
    public function save(BookInterface $Book)
    {
        /** @var BookInterface|AbstractModel $Book */
        try {
            $this->BookResource->save($Book);
        } catch (Exception $exception) {
            throw new CouldNotSaveException(__('Could not save the Book: %1', $exception->getMessage()));
        }

        return $Book;
    }

    /**
     * @param int $id
     * @return BookInterface
     * @throws LocalizedException
     */
    public function getById($id)
    {
        if (!isset($this->_instances[$id])) {
            /** @var BookInterface|AbstractModel $Book */
            $Book = $this->BookFactory->create();
            $this->BookResource->load($Book, $id);
            if (!$Book->getId()) {
                throw new NoSuchEntityException(__('Book does not exist'));
            }
            $this->instances[$id] = $Book;
        }

        return $this->instances[$id];
    }

    /**
     * @param BookInterface $Book
     * @return bool
     * @throws LocalizedException
     */
    public function delete(BookInterface $Book)
    {
        /** @var BookInterface|AbstractModel $Book */
        $id = $Book->getId();
        try {
            unset($this->instances[$id]);
            $this->BookResource->delete($Book);
        } catch (Exception $e) {
            throw new StateException(__('Unable to remove Book %1', $id));
        }
        unset($this->instances[$id]);

        return true;
    }

    /**
     * @param int $id
     * @return bool
     * @throws LocalizedException
     */
    public function deleteById($id)
    {
        return $this->delete($this->getById($id));
    }
}
