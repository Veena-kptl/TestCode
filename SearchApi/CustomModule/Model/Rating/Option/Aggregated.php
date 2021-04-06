<?php

namespace SearchApi\CustomModule\Model\Rating\Option;

use Magento\Framework\Model\AbstractModel;
use SearchApi\CustomModule\Model\ResourceModel\Rating\Option\Aggregated as AggregatedResourceModel;

/**
 * Aggregated vote model
 *
 * @api
 * @package SearchApi\CustomModule\Model\Rating\Option
 */
class Aggregated extends AbstractModel
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(AggregatedResourceModel::class);
    }
}

