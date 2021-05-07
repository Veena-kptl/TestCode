<?php

namespace CrudExample\CustomModule\Model\Book;

use Magento\Ui\DataProvider\AbstractDataProvider;
use CrudExample\CustomModule\Api\Data\BookInterface;
use CrudExample\CustomModule\Model\ResourceModel\Book\Collection;
use CrudExample\CustomModule\Model\ResourceModel\Book\CollectionFactory;
use CrudExample\CustomModule\Model\Book;

class DataProvider extends AbstractDataProvider
{
    /**
     * @var Collection
     */
    protected $collection;

    /**
     * @var array
     */
    protected $loadedData;

    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $collectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * @return array
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $items = $this->collection->getItems();

        /** @var BookInterface|Book $Book */
        foreach ($items as $Book) {
            $this->loadedData[$Book->getId()] = $Book->getData();
        }

        return $this->loadedData;
    }
}
