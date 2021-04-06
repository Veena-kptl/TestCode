<?php
namespace PostApi\CustomApi\Api;
interface Highlight
{
    /**
     * @api
     * @param \PostApi\CustomApi\Api\Data\Highlight[] $highlightData
     * @return array
     */
    public function update($highlightData);
}

