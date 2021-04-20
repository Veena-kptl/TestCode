<?php
namespace AdminFormGrid\CustomModule\Model\ResourceModel\Grid;
 
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
 
    
    protected function _construct()
    {
        $this->_init('AdminFormGrid\CustomModule\Model\Grid', 'AdminFormGrid\CustomModule\Model\ResourceModel\Grid');
    }

    public function getAvailableStatuses()
    {
       return [self::STATUS_ENABLED => __('Enabled'), self::STATUS_DISABLED => __('Disabled')];
    }
}
