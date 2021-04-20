<?php

namespace AdminFormGrid\CustomModule\Model\ResourceModel\Blog;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
 
class Collection extends AbstractCollection{
    protected function _construct()
    {
        $this->_init('AdminFormGrid\CustomModule\Model\Blogs', 'AdminFormGrid\CustomModule\Model\ResourceModel\Blogs');
    }
}
