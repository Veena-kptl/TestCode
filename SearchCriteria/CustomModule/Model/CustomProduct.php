<?php
    namespace  SearchCriteria\CustomModule\Model;    
    
    
    use SearchCriteria\CustomModule\Api\CustomProductInterface;
    
    class CustomProduct implements CustomProductInterface
    {
        protected $collection;
        /**
         * CustomerOrder constructor.
         *
         * @param productRepository $productCollectionFactory
         */
        public function __construct(
           \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
            \Magento\Catalog\Model\CategoryFactory $categoryFactory
        ) {
                $this->productCollectionFactory = $productCollectionFactory;
                $this->categoryFactory = $categoryFactory;
        }
    
        /**
         * Returns product data to user
         *
         * @api
         * @param  string $type type.
         * @return return order array collection.
         */
        public function getList($type)
        {
            $collection = $this->productCollectionFactory->create();
            $collection->addAttributeToFilter('type_id', ['eq' => $type]);
            $collection->setPageSize(3);
            $data=[];
            $i=0;
            foreach ($collection as $product) {
                $data[$i]['increment_id']=$product->getId();
                $data[$i]['created_at']=$product->getSku();
                $data[$i]['name']=$product->getName();
                $data[$i]['grand_total']=$product->getPrice();
                $data[$i]['status']=$product->getStatus();
                $i++;
            }
            return $data;
           
            
        }
    
       
    }
