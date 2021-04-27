<?php

namespace CrudExample\CustomModule\Block;

use Magento\Framework\View\Element\Template\Context;
use CrudExample\CustomModule\Model\BookFactory;
use Magento\Cms\Model\Template\FilterProvider;
/**
 * Book View block
 */
class BookView extends \Magento\Framework\View\Element\Template
{
    /**
     * @var Book
     */
    protected $_book;
    public function __construct(
        Context $context,
        BookFactory $book,
        FilterProvider $filterProvider
    ) {
        $this->_book = $book;
        $this->_filterProvider = $filterProvider;
        parent::__construct($context);
    }

    public function _prepareLayout()
    {
        $this->pageConfig->getTitle()->set(__('Book View Page'));
        
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
