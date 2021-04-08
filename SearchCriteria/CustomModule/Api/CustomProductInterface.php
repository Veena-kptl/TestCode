<?php
namespace  SearchCriteria\CustomModule\Api;


interface CustomProductInterface
{
    /**
     * Returns orders data to user
     *
     * @api
     * @param  string $type product type.
     * @return return order array collection.
     */
    public function getList($type);
}
