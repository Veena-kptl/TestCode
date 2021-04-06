<?php

namespace SearchApi\CustomModule\Model\ResourceModel\Rating\Option\Aggregated;

/**
 * Aggregated rating votes collection
 *
 * @package SearchApi\CustomModule\Model\ResourceModel\Rating\Option\Aggregated
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'primary_id';

    /**
     * @var string
     */
    protected $_eventPrefix = 'oxcom_rating_aggregated_collection';

    /**
     * @var string
     */
    protected $_eventObject = 'rating_aggregated_collection';

    /**
     * Define model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            \SearchApi\CustomModule\Model\Rating\Option\Aggregated::class,
            \SearchApi\CustomModule\Model\ResourceModel\Rating\Option\Aggregated::class
        );
    }
}

