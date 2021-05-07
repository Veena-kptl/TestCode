<?php
namespace PostApi\CustomApi\Api\Data;
interface Highlight
{
    const SKU = 'sku';
    const TITLE = 'title';
    /**
     * Gets the sku.
     *
     * @api
     * @return string
     */
    public function setSku($sku);
    /**
     * Gets the sku.
     *
     * @api
     * @return string
     */
    public function getSku();
    /**
     * Gets the title.
     *
     * @api
     * @return string
     */
    public function setTitle($title);
    /**
     * Gets the title.
     *
     * @api
     * @return string
     */
    public function getTitle();
}

