<?php

namespace UpdateStock\TaskModule\Controller\Index;

use Magento\Framework\App\Action\Context;
use Magento\Framework\Filesystem;

class Save extends \Magento\Framework\App\Action\Action
{
	protected $_product;
 
    /**
     * @var Magento\CatalogInventory\Api\StockStateInterface 
     */
    protected $_stockStateInterface;
 
    /**
     * @var Magento\CatalogInventory\Api\StockRegistryInterface 
     */
    protected $_stockRegistry;
 
    /**
    * @param Context $context
    * @param Magento\Catalog\Model\ProductFactory $productFactory
    * @param Magento\CatalogInventory\Api\StockStateInterface $stockStateInterface,
    * @param Magento\CatalogInventory\Api\StockRegistryInterface $stockRegistry
    */
    public function __construct(
        Context $context,
        \Magento\Catalog\Model\ProductFactory $productFactory,
        \Magento\CatalogInventory\Api\StockStateInterface $stockStateInterface,
        \Magento\CatalogInventory\Api\StockRegistryInterface $stockRegistry 
    ) {
        $this->productFactory = $productFactory;
        $this->_stockStateInterface = $stockStateInterface;
        $this->_stockRegistry = $stockRegistry;
        parent::__construct($context);
    }
	public function execute()
    {
        $data = $this->getRequest()->getParams();
        $product = $this->productFactory->create();
        $product->load($product->getIdBySku($data['product_sku']));
        $item=$product->getData();
        $stockItem=$this->_stockRegistry->getStockItem($item['entity_id']); // load stock of that product
		$stockItem->setData('is_in_stock',$data['stock_status']); //set updated data as your requirement
		$stockItem->setData('qty',$data['product_qty']); //set updated quantity 
        $stockItem->setData('manage_stock',1);
		$stockItem->setData('use_config_notify_stock_qty',1);
        if($stockItem->save()){
            $this->messageManager->addSuccessMessage(__('You saved the data.'));
        }else{
            $this->messageManager->addErrorMessage(__('Data was not saved.'));
        }
        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('stock');
        return $resultRedirect;
    }
}
