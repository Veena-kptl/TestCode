<?php
namespace CustomColl\CustomModule\Block;
class Index extends \Magento\Framework\View\Element\Template
{    
    protected $_productCollectionFactory;
        
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,        
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,        
        array $data = []
    )
    {    
        $this->_productCollectionFactory = $productCollectionFactory;    
        parent::__construct($context, $data);
    }
    
    public function getProductCollection()
    {
        $collection = $this->_productCollectionFactory->create();
        $collection->addAttributeToSelect('*');
        $collection->addAttributeToFilter('type_id', ['eq' => 'Configurable']);
        $collection->getSelect()->order('created_at', \Magento\Framework\DB\Select::SQL_DESC);
        $collection->getSelect()->limit(10);
        return $collection;
    }
}
?>
