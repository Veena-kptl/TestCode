<?php

namespace LoginRestriction\TaskModule\Model;

use LoginRestriction\TaskModule\Api\Data\IpInterface;

class Ip extends \Magento\Framework\Model\AbstractModel implements IpInterface
{
    /**
     * CMS page cache tag.
     */
    const CACHE_TAG = 'ipaddress_records';

    /**
     * @var string
     */
    protected $_cacheTag = 'ipaddress_records';

    /**
     * Prefix of model events names.
     *
     * @var string
     */
    protected $_eventPrefix = 'ipaddress_records';

    /**
     * Initialize resource model.
     */
    protected function _construct()
    {
        $this->_init('LoginRestriction\TaskModule\Model\ResourceModel\Ip');
    }
    /**
     * Get IpId.
     *
     * @return int
     */
    public function getEntityId()
    {
        return $this->getData(self::ENTITY_ID);
    }

    /**
     * Set IpId.
     */
    public function setEntityId($entityId)
    {
        return $this->setData(self::ENTITY_ID, $entityId);
    }

    /**
     * Get Message.
     *
     * @return varchar
     */
    public function getIpAddress()
    {
        return $this->getData(self::IP_ADDRESS);
    }

    /**
     * Set Message.
     */
    public function setIpAddress($ip_address)
    {
        return $this->setData(self::IP_ADDRESS, $ip_address);
    }
     /**
     * Get Message.
     *
     * @return varchar
     */
    public function getStatus()
    {
        return $this->getData(self::STATUS);
    }

    /**
     * Set Message.
     */
    public function setStatus($ip_status)
    {
        return $this->setData(self::STATUS, $ip_status);
    }
}
