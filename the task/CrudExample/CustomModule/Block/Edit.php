<?php
namespace CrudExample\CustomModule\Block;
class Edit extends \Magento\Framework\View\Element\Template
{
     public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        array $data = []
     ) {
        parent::__construct($context, $data);
        //get collection of data 
        $data = $this->getRequest()->getParams('id');
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
		$postCollection = $objectManager->create('CrudExample\CustomModule\Model\Book')->getCollection();
        $this->setCollection($postCollection);
    }
  
    protected function _prepareLayout()
    {
        parent::_prepareLayout();
    }

}
