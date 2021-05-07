<?php

namespace CacheType\CustomModule\Cache;

use Magento\Framework\App\Cache\StateInterface;
use Magento\Framework\App\Cache\Type\FrontendPool;

class Type extends \Magento\Framework\Cache\Frontend\Decorator\TagScope
{
    const TYPE_IDENTIFIER = 'uniq_identifire';
    const CACHE_TAG = 'uniq_tag';
    private $cacheState;

    public function __construct(
        FrontendPool $cacheFrontendPool,
        StateInterface $cacheState
    ) {
        parent::__construct($cacheFrontendPool->get(self::TYPE_IDENTIFIER), self::CACHE_TAG);
        $this->cacheState = $cacheState;
    }
    public function load($identifier)
    {
        if (!$this->isEnabled()) {
            return false;
        }
        return parent::load($identifier);
    }

    public function save($data, $identifier, array $tags = [], $lifeTime = null)
    {
        if (!$this->isEnabled()) {
            return false;
        }
        return parent::save($data, $identifier, $tags, $lifeTime);
    }

    public function isEnabled()
    {
        return $this->cacheState->isEnabled(self::TYPE_IDENTIFIER);
    }
}
