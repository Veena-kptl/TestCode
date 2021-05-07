<?php

namespace CrudExample\CustomModule\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use CrudExample\CustomModule\Api\Data\BookInterface;

class Book extends AbstractDb
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('test_book', BookInterface::KEY_ID);
    }
}
