<?php
namespace CustomApi\NewApi\Api;
interface Gethighlight
{
    /**
     * @api
     * @param string $sku
     * @return array
     */
    public function gethighlightdata($sku);
}
