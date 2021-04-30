<?php

namespace CrudExample\CustomModule\Block;

use Magento\Framework\View\Element\Template\Context;
use CrudExample\CustomModule\Model\BookFactory;

class EditView extends \Magento\Framework\View\Element\Template
{
     /**
     * @var Book
     */
    protected $_book;
    public function __construct(
        Context $context,
        BookFactory $book
    ) {
        $this->_book = $book;
        parent::__construct($context);
    }

  
    public function _prepareLayout()
    {
        $this->pageConfig->getTitle()->set(__('Book Edit Page'));
        
        return parent::_prepareLayout();
    }

    public function getSingleData()
    {
        $id = $this->getRequest()->getParam('id');
        $book = $this->_book->create();
        $singleData = $book->load($id);
        if($singleData->getId() && $singleData->getStatus() == 1){
            return $singleData;
        }else{
            return false;
        }
    }
}
