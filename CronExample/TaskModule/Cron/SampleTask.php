<?php

namespace CronExample\TaskModule\Cron;

use Psr\Log\LoggerInterface;
use Exception;
use Magento\Catalog\Api\CategoryLinkManagementInterface;
use Magento\Catalog\Api\Data\CategoryProductLinkInterface;

class SampleTask
{
    /**
     * @var LoggerInterface
     */
    protected $_logger;
     private $categoryLinkManagement;

    /**
     * @param LoggerInterface $logger
     */
    public function __construct(
        LoggerInterface $logger,
        CategoryLinkManagementInterface $categoryLinkManagement
    ) {
        $this->_logger = $logger;
        $this->categoryLinkManagement = $categoryLinkManagement;
    }

    public function execute()
    {
        $categoryIds=array('10');
        $hasProductAssignedSuccess = false;
        try {
            $hasProductAssignedSuccess = $this->categoryLinkManagement->assignProductToCategories($productSku, $categoryIds);
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
        $this->_logger->debug('Cron task was started at ' . date('Y-m-d h:i:s'));
    }
}
