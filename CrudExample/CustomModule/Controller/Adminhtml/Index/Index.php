<?php

namespace CrudExample\CustomModule\Controller\Adminhtml\Index;

use Magento\Framework\App\ResponseInterface;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    const ADMIN_RESOURCE = 'CrudExample_CustomModule::review';

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     */
    public function execute()
    {
        $manageEntity = __('Manage Book');

        /** @var Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->addBreadcrumb($manageEntity, $manageEntity);
        $resultPage->addBreadcrumb($manageEntity, $manageEntity);
        $resultPage->getConfig()->getTitle()->prepend($manageEntity);

        return $resultPage;
    }
}
