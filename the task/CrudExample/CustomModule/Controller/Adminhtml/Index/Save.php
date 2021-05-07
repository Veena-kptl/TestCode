<?php

namespace CrudExample\CustomModule\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\Controller\ResultInterface;
use CrudExample\CustomModule\Api\Data\BookInterface;
use CrudExample\CustomModule\Api\BookRepositoryInterface;
use CrudExample\CustomModule\Model\Book;
use CrudExample\CustomModule\Model\BookFactory;
use Throwable;

class Save extends Action
{
    const ADMIN_RESOURCE = 'CrudExample_CustomModule::save';

    /**
     * @var BookRepositoryInterface
     */
    private $bookRepository;

    /**
     * @var BookFactory
     */
    private $bookFactory;

    /**
     * @param Action\Context $context
     * @param BookRepositoryInterface $bookRepository
     * @param BookFactory $bookFactory
     */
    public function __construct(
        Action\Context $context,
        BookRepositoryInterface $bookRepository,
        BookFactory $bookFactory
    ) {
        parent::__construct($context);
        $this->bookRepository = $bookRepository;
        $this->bookFactory = $bookFactory;
    }

    /**
     * @return ResultInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function execute()
    {
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $id = $this->getRequest()->getParam('id');
        $data = $this->getRequest()->getParams();
          $data[BookInterface::KEY_AUTHOR]=implode(',',$data[BookInterface::KEY_AUTHOR]);
            $data[BookInterface::KEY_LANG]=implode(',',$data[BookInterface::KEY_LANG]);
            $data[BookInterface::KEY_PRODUCT_ID]='1';
        /** @var Book $book */
        if ($id) {
            $book = $this->bookRepository->getById($id);
        } else {
            unset($data[BookInterface::KEY_ID]);
            $book = $this->bookFactory->create();
        }

        unset($data[BookInterface::KEY_UPDATED_AT]);
        $book->setData($data);

        try {
            $this->bookRepository->save($book);
            $this->messageManager->addSuccessMessage(__('Record saved successfully'));

            if (key_exists('back', $data) && $data['back'] == 'edit') {

                return $resultRedirect->setPath('*/*/edit', ['id' => $id, '_current' => true]);
            }

            return $resultRedirect->setPath('*/*/');
        } catch (Exception $e) {
            $this->messageManager->addErrorMessage(__("Record not saved".$e->getMessage()));

            return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
        }
    }
}
