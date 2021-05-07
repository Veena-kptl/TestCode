<?php
namespace AffectedProducts\TaskModule\Controller\Adminhtml\Products;


abstract class Product extends \Magento\Backend\App\Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'AffectedProducts_TaskModule::item_list';


}
