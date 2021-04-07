<?php
namespace SearchCriteria\CustomModule\Api;
 
/**
 * @api
 */
interface CategoryLinkManagementInterface
{
    /**
     * Get products assigned to a category
     *
     * @param string $type
     * @return \CustomModule\CustomSearch\Api\Data\CategoryProductLinkInterface[]
     */
    public function getAssignedProducts($type);
}
