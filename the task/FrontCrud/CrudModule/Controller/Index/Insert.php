<?php
namespace FrontCrud\CrudModule\Controller\Index;
 
class Insert extends \Magento\Framework\App\Action\Action
{
     protected $_pageFactory;
 
     public function __construct(
          \Magento\Framework\App\Action\Context $context,
          \Magento\Framework\View\Result\PageFactory $pageFactory
          )
     {
          $this->_pageFactory = $pageFactory;
          return parent::__construct($context);
     }
 
     public function execute()
     {
            //die("insert page");
          return $this->_pageFactory->create();
     }
}

