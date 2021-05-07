<?php
namespace PostApi\CustomApi\Model;
class Highlightdata implements \PostApi\CustomApi\Api\Data\Highlight
{
    protected $sku;
    protected $title;
    /**
     * Gets the sku.
     *
     * @api
     * @return string
     */
    public function setSku($sku)
    {
        $this->sku = $sku;
    }
    /**
     * Gets the sku.
     *
     * @api
     * @return string
     */
    public function getSku()
    {
        return $this->sku;
    }
    /**
     * Gets the title.
     *
     * @api
     * @return string
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }
    /**
     * Gets the title.
     *
     * @api
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }
}

