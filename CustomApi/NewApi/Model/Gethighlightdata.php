<?php
namespace CustomApi\NewApi\Model;
use CustomApi\NewApi\Api\Gethighlight;
use Magento\Catalog\Model\ProductFactory;
class Gethighlightdata implements Gethighlight
{
    protected $productFactory;
    public function __construct(
        ProductFactory $productFactory
    ) {
        $this->productFactory = $productFactory;
    }
    public function gethighlightdata($sku)
    {
        $productId = $this->resolveProductId($sku);
        if (is_numeric($productId)) {
            $mainarray = [];
            $ary_response = [];
            $valid = [
                "code" => "200",
                "sku" => $sku,
                "product_id" => $productId
            ];
            $ary_response[] = $valid;
        } else {
            $ary_response[] = $productId;
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

