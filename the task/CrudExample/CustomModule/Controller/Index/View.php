<?php

namespace CrudExample\CustomModule\Controller\Index;

use Magento\Framework\App\Action\Context;
use Magento\Framework\Exception\NotFoundException;
use CrudExample\CustomModule\Block\BookView;

class View extends \Magento\Framework\App\Action\Action
{
	protected $_bookview;

	public function __construct(
        Context $context,
        BookView $bookview
    ) {
        $this->_bookview = $bookview;
        parent::__construct($context);
    }

	public function execute()
    {
    	if(!$this->_bookview->getSingleData()){
    		throw new NotFoundException(__('Parameter is incorrect.'));
    	}
    	
        $this->_view->loadLayout();
        $this->_view->getLayout()->initMessages();
        $this->_view->renderLayout();
    }
}
