<?php

namespace CrudExample\CustomModule\Model\ResourceModel\Book;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use CrudExample\CustomModule\Model\Book as Model;
use CrudExample\CustomModule\Model\ResourceModel\Book as ResourceModel;
use CrudExample\CustomModule\Api\Data\BookInterface;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = BookInterface::KEY_ID;

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}
