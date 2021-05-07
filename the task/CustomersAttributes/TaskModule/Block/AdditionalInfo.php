<?php
namespace CustomersAttributes\TaskModule\Block;

use Psr\Log\LoggerInterface;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;


/**
 * Customer Additional Info block
 *
 */
class AdditionalInfo extends \Magento\Customer\Block\Account\Dashboard
{
	private $logger;
}
