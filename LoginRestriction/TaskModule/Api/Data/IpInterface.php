<?php

namespace LoginRestriction\TaskModule\Api\Data;

/**
 * Entity interface.
 */

interface IpInterface
{
    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const ENTITY_ID = 'ip_id';
    const IP_ADDRESS = 'ip_address';
    const STATUS = 'ip_status';

   /**
    * Get EntityId.
    *
    * @return int
    */
    public function getEntityId();

   /**
    * Set EntityId.
    */
    public function setEntityId($entityId);

   /**
    * Get Message.
    *
    * @return varchar
    */
    public function getIpAddress();

   /**
    * Set Message.
    */
    public function setIpAddress($ip_address); 
    
    /**
    * Get Message.
    *
    * @return varchar
    */
    public function getStatus();

   /**
    * Set Message.
    */
    public function setStatus($ip_status);    
}
