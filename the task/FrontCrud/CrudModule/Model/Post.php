<?php
namespace FrontCrud\CrudModule\Model;
 
class Post extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
        const CACHE_TAG = 'modulename_records';

    /**
     * @var string
     */
         protected $_cacheTag = 'modulename_records';

    /**
     * Prefix of model events names.
     *
     * @var string
     */
        protected $_eventPrefix = 'modulename_records';
        protected function _construct()
        {
                $this->_init('FrontCrud\CrudModule\Model\ResourceModel\Post');
        }
 
        public function getIdentities()
        {
                return [self::CACHE_TAG . '_' . $this->getId()];
        }
 
        public function getDefaultValues()
        {
                $values = [];
 
                return $values;
        }
}
