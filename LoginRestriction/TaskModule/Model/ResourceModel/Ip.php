<?php

namespace LoginRestriction\TaskModule\Model\ResourceModel;

/**
 * Modulename Entity mysql resource.
 */
class Ip extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Construct.
     *
     * @param \Magento\Framework\Model\ResourceModel\Db\Context $context
     *
     */
    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context
    ) 
    {
        parent::__construct($context);
    }
 
    /**
     * Initialize resource model.
     */
    protected function _construct()
    {
        $this->_init('ip_address', 'ip_id', 'ip_status');
    }
}
