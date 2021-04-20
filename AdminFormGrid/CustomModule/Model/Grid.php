<?php
namespace AdminFormGrid\CustomModule\Model;
 
class Grid extends \Magento\Framework\Model\AbstractModel
{
    
    protected function _construct()
    {
        $this->_init('AdminFormGrid\CustomModule\Model\ResourceModel\Grid');
    }
}
 
?>
