<?php

namespace CrudExample\CustomModule\Block;

use Magento\Framework\View\Element\Template\Context;
use CrudExample\CustomModule\Model\BookFactory;
/**
 * book List block
 */
class BookListData extends \Magento\Framework\View\Element\Template
{
    /**
     * @var book
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
        $this->pageConfig->getTitle()->set(__('Book List Page'));
        
        if ($this->getbookCollection()) {
            $pager = $this->getLayout()->createBlock(
                'Magento\Theme\Block\Html\Pager',
                'book.crud.pager'
            )->setAvailableLimit(array(5=>5,10=>10,15=>15))->setShowPerPage(true)->setCollection(
                $this->getbookCollection()
            );
            $this->setChild('pager', $pager);
            $this->getbookCollection()->load();
        }
        return parent::_prepareLayout();
    }

    public function getbookCollection()
    {
        $page = ($this->getRequest()->getParam('p'))? $this->getRequest()->getParam('p') : 1;
        $pageSize = ($this->getRequest()->getParam('limit'))? $this->getRequest()->getParam('limit') : 5;

        $book = $this->_book->create();
        $collection = $book->getCollection();
        $collection->addFieldToFilter('status','1');
        //$book->setOrder('book_id','ASC');
        $collection->setPageSize($pageSize);
        $collection->setCurPage($page);

        return $collection;
    }

    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }
}
