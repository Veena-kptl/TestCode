<?php

namespace GraphQl\CustomModule\Controller\Adminhtml\Author;
 
use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class Index
 * @package GraphQl\CustomModule\Controller\Adminhtml\Author
 */
class Index extends \Magento\Backend\App\Action
{
    
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;
 
    /**
     * @param Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        Action\Context $context,
        PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }
 
    /**
     * {@inheritdoc}
     */
    protected function _isAllowed()
    {
        return true;
    }
    
   /**
    * (non-PHPdoc)
    * @see \Magento\Framework\App\ActionInterface::execute()
    */
    public function execute()
    {
    	$resultPage = $this->resultPageFactory->create();
    	$resultPage->getConfig()->getTitle()->prepend(__('Authors'));
    	return $resultPage;
    }
}

