<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AdminFormGrid\CustomModule\Model;
use Magento\Framework\Model\AbstractModel;
class Blogs extends \Magento\Framework\Model\AbstractModel
{

    protected function _construct()
    {
        $this->_init('AdminFormGrid\CustomModule\Model\ResourceModel\Blogs');
    }
}
