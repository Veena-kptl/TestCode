<?php

namespace LoginRestriction\TaskModule\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface IpSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get list.
     *
     * @return ReviewInterface[]
     */
    public function getItems();

    /**
     * Set list.
     *
     * @param ReviewInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
