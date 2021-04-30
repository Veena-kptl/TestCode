<?php

namespace LoginRestriction\TaskModule\Model\ResourceModel\Ip;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'ip_id';

    /**
     * Load data for preview flag
     *
     * @var bool
     */
    protected $_previewFlag;

    /**
     * Event prefix
     *
     * @var string
     */
    protected $_eventPrefix = 'ipaddress_entity_collection';

    /**
     * Event object
     *
     * @var string
     */
    protected $_eventObject = 'entity_collection';

	/**
	 * Define resource model
	 *
	 * @return void
	 */
	protected function _construct()
	{
		$this->_init('LoginRestriction\TaskModule\Model\Ip', 'LoginRestriction\TaskModule\Model\ResourceModel\Ip');
	}
}
