<?php
namespace Plugin\Trial\Model;
 
class ProductCart
{
    public function aroundAddProduct(
        \Magento\Checkout\Model\Cart $subject,
        \Closure $proceed,
        $productInfo,
        $requestInfo = null
    ) {
        $requestInfo['qty'] = 5; // Increased quantity to 5
        $result = $proceed($productInfo, $requestInfo);
        // Apply logic here
        return $result;
    }
}
