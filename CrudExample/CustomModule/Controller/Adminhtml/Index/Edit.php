<?php

namespace CrudExample\CustomModule\Controller\Adminhtml\Index;

use Exception;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use CrudExample\CustomModule\Api\Data\BookInterface;
use CrudExample\CustomModule\Api\BookRepositoryInterface;
use CrudExample\CustomModule\Model\BookFactory;

class Edit extends Action
{
    const ADMIN_RESOURCE = 'CrudExample_CustomModule::book';

    /**
     * @var bookRepositoryInterface
     */
    private $bookRepository;

    /**
     * @var bookFactory
     */
    private $bookFactory;

    /**
     * @param Context $context
     * @param bookRepositoryInterface $bookRepository
     * @param bookFactory $bookFactory
     */
    public function __construct(
        Context $context,
        bookRepositoryInterface $bookRepository,
        bookFactory $bookFactory
    ) {
        parent::__construct($context);
        $this->bookRepository = $bookRepository;
        $this->bookFactory = $bookFactory;
    }


    /**
     * @return void
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');

        if ($id) {
            try {
                /** @var bookInterface $model */
                $model = $this->bookRepository->getById($id);
            } catch (Exception $exception) {
                $this->messageManager->addErrorMessage(__('This Book no longer exists.'));
                $this->_redirect('book/*');

                return;
            }
        } else {
            $model = $this->bookFactory->create();
        }

        $this->_initAction();
        $this->_view->getPage()->getConfig()->getTitle()->prepend(__('Books'));
        $this->_view->getPage()->getConfig()->getTitle()->prepend(
            $model->getId() ? __("Edit Book '%1'", $model->getId()) : __('New Book')
        );

        $breadcrumb = $id ? __('Edit Rule') : __('New Rule');
        $this->_addBreadcrumb($breadcrumb, $breadcrumb);
        $this->_view->renderLayout();
    }

    /**
     * @return $this
     */
    protected function _initAction()
    {
        $this->_view->loadLayout();
        $this->_setActiveMenu('CrudExample_CustomModule::book');

        return $this;
    }
}
