<?php

namespace UIComponent\CustomModule\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface DataSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get data list.
     *
     * @return \UIComponent\CustomModule\Api\Data\DataInterface[]
     */
    public function getItems();

    /**
     * Set data list.
     *
     * @param \UIComponent\CustomModule\Api\Data\DataInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
