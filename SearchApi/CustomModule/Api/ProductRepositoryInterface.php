<?php

namespace SearchApi\CustomModule\Api;

interface ProductRepositoryInterface
{
    const FILTER_TYPE_TOP_SELLING = 'selling';
    const FILTER_TYPE_TOP_FREE    = 'free';
    const FILTER_TYPE_TOP_RATED   = 'rated';

    /**
     * @param string                                                       $type Type of source
     * @param \SearchApi\CustomModule\Api\ProductSearchCriteriaInterface $searchCriteria
     *
     * @return \SearchApi\CustomModule\Api\Data\ProductSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList($type, ProductSearchCriteriaInterface $searchCriteria = null);
}
