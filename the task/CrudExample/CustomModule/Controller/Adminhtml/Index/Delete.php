<?php

namespace CrudExample\CustomModule\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\Controller\ResultInterface;
use CrudExample\CustomModule\Api\BookRepositoryInterface;

class Delete extends Action
{
    const ADMIN_RESOURCE = 'CrudExample_CustomModule::delete';

    /**
     * @var BookRepositoryInterface
     */
    private $bookRepository;

    /**
     * @param Action\Context $context
     * @param BookRepositoryInterface $bookRepository
     */
    public function __construct(
        Action\Context $context,
        BookRepositoryInterface $bookRepository
    ) {
        parent::__construct($context);

        $this->bookRepository = $bookRepository;
    }

    /**
     * @return ResultInterface
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');

        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            try {
                $this->bookRepository->deleteById($id);
                $this->messageManager->addSuccessMessage(__('The Book has been deleted.'));

                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());

                return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
            }
        }
        $this->messageManager->addErrorMessage(__('We can\'t find a Book to delete.'));

        return $resultRedirect->setPath('*/*/');
    }
}
