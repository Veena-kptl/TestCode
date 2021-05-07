<?php

namespace FrontendCrud\CustomModule\Model\ResourceModel\Os;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection {

    protected $_idFieldName = 'ticket_id';
    protected $_eventPrefix = 'customer_os_collection';
    protected $_eventObject = 'os_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct() {
        $this->_init('FrontendCrud\CustomModule\Model\Os', 'FrontendCrud\CustomModule\Model\ResourceModel\Os');
    }

}

