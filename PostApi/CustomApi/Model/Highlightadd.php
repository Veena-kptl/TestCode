<?php
namespace PostApi\CustomApi\Model;
use PostApi\CustomApi\Api\Highlight;
use Magento\Catalog\Model\ProductFactory;
class Highlightadd implements Highlight
{
    protected $productFactory;
    public function __construct(
        ProductFactory $productFactory
    ) {
        $this->productFactory = $productFactory;
    }
    public function update($highlightData)
    {
        $ary_response = [];
        foreach ($highlightData as $value) {
            $productSku = $value->getSku();
            $productId = $this->resolveProductId($productSku);
            if (is_numeric($productId)) {
                $valid = [
                    "code" => "200",
                    "message" => "Record saved successfully.",
                    "sku" => $productSku,
                    "title" => $value->getTitle(),
                ];
                $ary_response[] = $valid;
            } else {
                $ary_response[] = $productId;
            }
        }
        return $ary_response;
    }
    /**
     * @param string $productSku
     * @return int
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    protected function resolveProductId($productSku)
    {
        $product = $this->productFactory->create();
        $productId = $product->getIdBySku($productSku);
        if (!$productId) {
            $invalid = ["code" => '301', "message" => "SKU " . $productSku . " Not Found On Magento"];
            return $invalid;
        }
        return $productId;
    }
}
