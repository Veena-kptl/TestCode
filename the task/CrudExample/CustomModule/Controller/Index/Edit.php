<?php

namespace CrudExample\CustomModule\Controller\Index;

use Magento\Framework\App\Action\Context;
use Magento\Framework\Exception\NotFoundException;
use CrudExample\CustomModule\Block\EditView;

class Edit extends \Magento\Framework\App\Action\Action
{
	protected $_editview;

	public function __construct(
        Context $context,
        EditView $editview
    ) {
        $this->_editview = $editview;
        parent::__construct($context);
    }

	public function execute()
    {
    	if(!$this->_editview->getSingleData()){
    		throw new NotFoundException(__('Parameter is incorrect.'));
    	}
    	
        $this->_view->loadLayout();
        $this->_view->getLayout()->initMessages();
        $this->_view->renderLayout();
    }
}
