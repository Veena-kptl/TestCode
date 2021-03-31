<?php
namespace ModuleSchema\CustomSchema\Model;
class Post extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
	const CACHE_TAG = 'helloworld_post';

	protected $_cacheTag = 'helloworld_post';

	protected $_eventPrefix = 'helloworld_post';

	protected function _construct()
	{
		$this->_init('ModuleSchema\CustomSchema\Model\ResourceModel\Post');
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
