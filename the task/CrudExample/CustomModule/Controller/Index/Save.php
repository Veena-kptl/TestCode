<?php

namespace CrudExample\CustomModule\Controller\Index;

use Magento\Framework\App\Action\Context;
use CrudExample\CustomModule\Api\Data\BookInterface;
use CrudExample\CustomModule\Api\BookRepositoryInterface;
use CrudExample\CustomModule\Model\Book;
use CrudExample\CustomModule\Model\BookFactory;
use Magento\Framework\Filesystem;

class Save extends \Magento\Framework\App\Action\Action
{
	/**
     * @var Book
     */
    protected $_book;

    public function __construct(
		Context $context,
        BookRepositoryInterface $bookRepository,
        BookFactory $book
    ) {
        $this->_book = $book;
        $this->bookRepository = $bookRepository;
        parent::__construct($context);
    }
	public function execute()
    {
        $data = $this->getRequest()->getParams();
    	$book = $this->_book->create();
        $data[BookInterface::KEY_AUTHOR]=implode(',',$data[BookInterface::KEY_AUTHOR]);
            $data[BookInterface::KEY_LANG]=implode(',',$data[BookInterface::KEY_LANG]);
            $data[BookInterface::KEY_PRODUCT_ID]='1';
        $book->setData($data);
        if($this->bookRepository->save($book)){
            $this->messageManager->addSuccessMessage(__('You saved the data.'));
        }else{
            $this->messageManager->addErrorMessage(__('Data was not saved.'));
        }
        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('book');
        return $resultRedirect;
    }
}
