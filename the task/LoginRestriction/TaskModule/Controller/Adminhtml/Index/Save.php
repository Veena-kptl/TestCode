<?php

namespace LoginRestriction\TaskModule\Controller\Adminhtml\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use LoginRestriction\TaskModule\Model\IpFactory;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Session\SessionManagerInterface;

class Save extends Action
{

    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'LoginRestriction_TaskModule::ip';

    /**
     * @var IpFactory
    */
    protected $_ipFactory;
    
    /**
     * @var PageFactory
    */
    protected $resultPageFactory;

    /**
     * @var SessionManagerInterface
    */
    protected $_sessionManager;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory,
     * @param \LoginRestriction\TaskModule\Model\IpFactory $ipFactory,
     * @param \Magento\Framework\Session\SessionManagerInterface $sessionManager
     */
    public function __construct(
        Context $context,
        IpFactory $ipFactory,
        PageFactory  $resultPageFactory,
        SessionManagerInterface $sessionManager
    )
    {
        parent::__construct($context);
        $this->_ipFactory = $ipFactory;
        $this->resultPageFactory = $resultPageFactory;
        $this->_sessionManager = $sessionManager;
        
    }
    
    /**
     * Save action
    */
    public function execute()
    {   
        $resultRedirect     = $this->resultRedirectFactory->create();
        $ipModel        = $this->_ipFactory->create();
        $data               = $this->getRequest()->getPost(); 
        //echo "<pre>"; var_dump($data); die();
        try{
            if (!empty($data['ip_id'])) {
                $ipModel->setIpId($data['ip_id']);
            }
            $ipModel->setData('ip_address', $data['ip_address']);
            $ipModel->setData('ip_status', $data['ip_status']);
            $ipModel->save();
            //check for `back` parameter
            if ($this->getRequest()->getParam('back')) { 
                return $resultRedirect->setPath('*/*/edit', ['ip_id' => $ipModel->getId(), '_current' => true, '_use_rewrite' => true]);
            }

            $this->_redirect('*/*');
            $this->messageManager->addSuccess(__('The Ip has been saved.'));

        }catch(\Exception $e){
            $this->messageManager->addError(__($e->getMessage()));
        }        
        
    }
}
