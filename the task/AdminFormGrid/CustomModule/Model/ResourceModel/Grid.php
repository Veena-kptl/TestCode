<?php
namespace AdminFormGrid\CustomModule\Model\ResourceModel;
 
class Grid extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    
    protected function _construct()
    {
        $this->_init('emipro_blog', 'id');
    }
}
