<?php
namespace CustomModule\CustomSearch\Api;
 
/**
 * @api
 */
interface CategoryLinkManagementInterface
{
    /**
     * Get products assigned to a category
     *
     * @param int $categoryId
     * @return \CustomModule\CustomSearch\Api\Data\CategoryProductLinkInterface[]
     */
    public function getAssignedProducts($categoryId);
}
