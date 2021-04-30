<?php

namespace LoginRestriction\TaskModule\Controller\Adminhtml\Index;

use Magento\Backend\App\Action\Context;
use LoginRestriction\TaskModule\Model\IpFactory;
use Magento\Framework\Controller\ResultFactory;
    
class Addnew extends \Magento\Backend\App\Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'LoginRestriction_TaskModule::entity';

    
    /**
     * @var \LoginRestriction\TaskModule\Model\IpFactory
     */
    private $ipFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \LoginRestriction\TaskModule\Model\IpFactory $ipFactory
     */
    public function __construct(
        Context $context,
        IpFactory $ipFactory
    ) {
        parent::__construct($context);
        $this->ipFactory = $ipFactory;            
    }
    

    /**
     * Create new Ip
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {   
        
        $this->ipFactory->create();
        
        
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->setActiveMenu('LoginRestriction_TaskModule::ip_menu');
        
        $title = "Ip Information";
        
        $resultPage->getConfig()->getTitle()->prepend($title);
        
        return $resultPage;
    }
}  
