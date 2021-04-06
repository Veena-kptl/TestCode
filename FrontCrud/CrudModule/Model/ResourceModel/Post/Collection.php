<?php
namespace FrontCrud\CrudModule\Model\ResourceModel\Post;
 
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
        /**
         * Define resource model
         *
         * @return void
         */
        protected function _construct()
        {
                $this->_init('FrontCrud\CrudModule\Model\Post', 'FrontCrud\CrudModule\Model\ResourceModel\Post');
        }
}

