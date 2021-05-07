<?php

namespace FrontendCrud\CustomModule\Model;

use Magento\Framework\Model\AbstractModel;
use Magento\Framework\DataObject\IdentityInterface;

class Os extends AbstractModel implements IdentityInterface {

    const CACHE_TAG = 'customer_create';

    protected $_cacheTag = 'customer_create';
    protected $_eventPrefix = 'customer_create';

    protected function _construct() {
        $this->_init('FrontendCrud\CustomModule\Model\ResourceModel\Os');
    }

    public function getIdentities() {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getDefaultValues() {
        $values = [];
        return $values;
    }

}

