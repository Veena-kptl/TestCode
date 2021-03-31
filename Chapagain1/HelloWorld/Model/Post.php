<?php
namespace Chapagain1\HelloWorld\Model;
class Post extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
	const CACHE_TAG = 'my_custom_table';

	protected $_cacheTag = 'my_custom_table';

	protected $_eventPrefix = 'my_custom_table';

	protected function _construct()
	{
		$this->_init('Chapagain\HelloWorld\Model\ResourceModel\Post');
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
