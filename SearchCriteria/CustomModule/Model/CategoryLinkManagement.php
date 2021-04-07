<?php
namespace SearchCriteria\CustomModule\Model;
 
/**
 * Class CategoryLinkManagement
 */
class CategoryLinkManagement implements \SearchCriteria\CustomModule\Api\CategoryLinkManagementInterface
{
    /**
     * @var \Magento\Catalog\Api\CategoryRepositoryInterface
     */
    protected $categoryRepository;
 
    /**
     * @var \SearchCriteria\CustomModule\Api\Data\CategoryProductLinkInterfaceFactory
     */
    protected $productLinkFactory;
 
   
    public function __construct(
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
        \SearchCriteria\CustomModule\Api\Data\CategoryProductLinkInterfaceFactory $productLinkFactory
    ) {
        $this->productRepository = $productRepository;
        $this->productLinkFactory = $productLinkFactory;
    }
 
    /**
     * {@inheritdoc}
     */
    public function getAssignedProducts($categoryId)
    {
        $category = $this->categoryRepository->get($categoryId);
        if (!$category->getIsActive()) {
            return [[
                'error' => true,
                'error_desc' => 'Category is disabled'
            ]];
        }
        $categoryDesc = $category->getDescription();
 
        /** @var \Magento\Catalog\Model\ResourceModel\Product\Collection $products */
        $products = $category->getProductCollection()
            ->addFieldToSelect('position')
            ->addFieldToSelect('name')
            ->addFieldToSelect('price');
 
        /** @var \SearchCriteria\CustomModule\Api\Data\CategoryProductLinkInterface[] $links */
        $links = [];
 
        /** @var \Magento\Catalog\Model\Product $product */
        foreach ($products->getItems() as $product) {
            /** @var \SearchCriteria\CustomModule\Api\Data\CategoryProductLinkInterface $link */
            $link = $this->productLinkFactory->create();
            $link->setSku($product->getSku())
                ->setName($product->getName())
                ->setPrice($product->getFinalPrice())
                ->setPosition($product->getData('cat_index_position'))
                ->setCategoryDescription($categoryDesc);
            $links[] = $link;
        }
 
        return $links;
    }
}
