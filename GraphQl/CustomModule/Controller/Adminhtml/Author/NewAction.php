<?php

namespace GraphQl\CustomModule\Controller\Adminhtml\Author;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class NewAction
 * @package GraphQl\CustomModule\Controller\Adminhtml\Author
 */
class NewAction extends \Magento\Backend\App\Action
{
    /**
     * 
     * @param \Magento\Backend\App\Action\Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
    	PageFactory $resultPageFactory
    ) {
    	$this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }
    
    /**
     * (non-PHPdoc)
     * @see \Magento\Framework\App\ActionInterface::execute()
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Ced_Author::author');
        $resultPage->getConfig()->getTitle()->prepend(__('Author'));
        $resultPage->getConfig()->getTitle()->prepend(__('New Author'));
        return $resultPage;
    }
}

