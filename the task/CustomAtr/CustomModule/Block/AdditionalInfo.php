<?php
namespace CustomAtr\CustomModule\Block;

use Psr\Log\LoggerInterface;
use Magento\Customer\Api\CustomerRepositoryInterface;


/**
 * Customer Additional Info block
 *
 */
class AdditionalInfo extends \Magento\Customer\Block\Account\Dashboard
{
	private $logger;
}
