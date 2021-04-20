<?php

namespace GraphQl\CustomModule\Block\Adminhtml\Edit\Book;

use Magento\Customer\Api\AccountManagementInterface;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Magento\Framework\App\Request\Http;

/**
 * Class SaveButton
 * @package GraphQl\CustomModule\Block\Adminhtml\Edit\Book
 */
class SaveButton extends GenericButton implements ButtonProviderInterface
{

    /**
     * SaveButton constructor.
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param \Magento\Framework\Registry $registry
     */
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry,
    	Http $request
    ) {
        parent::__construct($context, $registry);
        $this->request = $request;
        
    }

    /**
     * @return array
     */
    public function getButtonData()
    {
    	return [
    	'label' => __('Save Book'),
    	'class' => 'save primary',
    	'data_attribute' => [
    	'mage-init' => ['button' => ['event' => 'save']],
    	'form-role' => 'save',
    	],
    	'sort_order' => 90,
    	];    
        
    }
}

