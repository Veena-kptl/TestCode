<?php

namespace SearchApi\CustomModule\Api\Data;

/**
 * Search results interface.
 *
 * @api
 * @package SearchApi\CustomModule\Api\Data
 */
interface ProductSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * Gets collection items.
     *
     * @return \SearchApi\CustomModule\Api\Data\ProductInterface[] Array of collection items.
     */
    public function getItems();

    /**
     * Set collection items.
     *
     * @param \SearchApi\CustomModule\Api\Data\ProductInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

