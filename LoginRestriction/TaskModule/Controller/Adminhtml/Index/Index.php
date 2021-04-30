<?php

    namespace LoginRestriction\TaskModule\Controller\Adminhtml\Index;

    class Index extends \Magento\Backend\App\Action
    {
        /**
         * Authorization level of a basic admin session
         *
         * @see _isAllowed()
         */
        const ADMIN_RESOURCE = 'LoginRestriction_TaskModule::ip';

        /**
        * @var \Magento\Framework\View\Result\PageFactory
        */
        protected $resultPageFactory;

        /**
         * Constructor
         *
         * @param \Magento\Backend\App\Action\Context $context
         * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
         */
        public function __construct(
            \Magento\Backend\App\Action\Context $context,
            \Magento\Framework\View\Result\PageFactory $resultPageFactory
        ) {
                parent::__construct($context);
                $this->resultPageFactory = $resultPageFactory;
        }

        /**
         * Load the page defined in view/adminhtml/layout/routeadminlabel_controllername_index.xml
         *
         * @return \Magento\Framework\View\Result\Page
         */
        public function execute()
        {
            $resultPage = $this->resultPageFactory->create();
            //$resultPage->setActiveMenu('LoginRestriction_TaskModule::ip_menu');

            $resultPage->getConfig()->getTitle()->prepend((__('IP Address List')));

            return $resultPage;
        }
        
    }
?>
  
