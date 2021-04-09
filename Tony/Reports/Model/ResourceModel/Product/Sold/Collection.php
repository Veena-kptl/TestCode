<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

/**
 * Report Sold Products collection
 *
 * @author      Magento Core Team <core@magentocommerce.com>
 */
namespace Tony\Reports\Model\ResourceModel\Product\Sold;

/**
 * @SuppressWarnings(PHPMD.DepthOfInheritance)
 */
class Collection extends \Magento\Reports\Model\ResourceModel\Order\Collection
{
    /**
     * Set Date range to collection
     *
     * @param int $from
     * @param int $to
     * @return $this
     */
    public function setDateRange($from, $to)
    {
        $this->_reset()->addAttributeToSelect(
            '*'
        )->addOrderedQty(
            $from,
            $to
        )->setOrder('ordered_qty',self::SORT_ORDER_DESC);
        return $this;
    }

    /**
     * Add ordered qty's
     *
     * @param string $from
     * @param string $to
     * @return $this
     */
    public function addOrderedQty($from = '', $to = '')
    {
        $connection = $this->getConnection();
        $orderTableAliasName = $connection->quoteIdentifier('order');
        //$countCollection = Mage::getResourceModel('catalog/product_collection');

        $_objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $compositeTypeIds = $_objectManager->get('Magento\Catalog\Model\Product\Type')->getCompositeTypes();
        $productTypes = $this->getConnection()->quoteInto(' AND (e.type_id NOT IN (?))', $compositeTypeIds);

        $orderJoinCondition = [
            $orderTableAliasName . '.entity_id = order_items.order_id',
            $connection->quoteInto("{$orderTableAliasName}.state <> ?", \Magento\Sales\Model\Order::STATE_CANCELED),
            $connection->quoteInto("{$orderTableAliasName}.state = ?", \Magento\Sales\Model\Order::STATE_CLOSED),
        ];
        
        

        if ($from != '' && $to != '') {
            $fieldName = $orderTableAliasName . '.created_at';
            $orderJoinCondition[] = $this->prepareBetweenSql($fieldName, $from, $to);
        }

        $this->getSelect()->reset()->from(
            ['order_items' => $this->getTable('sales_order_item')],
           
          
            ['ordered_qty' => 'SUM(order_items.qty_ordered)', 'order_items_increment_id'=>'order.increment_id', 'order_items_name' => 'order_items.name', 'order_items_sku'=>'order_items.sku', 'order_items_color'=>'CONCAT("Size - ",at_size_value.value,", Color - ",at_color_value.value)', 'return_qty' => 'SUM(order_items.qty_refunded)']
            
        )->joinInner(
            ['order' => $this->getTable('sales_order')],
            implode(' AND ', $orderJoinCondition),
            'customer_id'
        )
        ->joinLeft(array('ce' => 'catalog_product_entity'),"order_items.sku=ce.sku ")
        ->joinLeft(array('ea' => 'eav_attribute'),"ce.attribute_set_id=ea.entity_type_id  and ea.attribute_code='size'")
        ->joinLeft(array('at_size' => 'catalog_product_entity_int'),"ce.entity_id = at_size.entity_id AND at_size.attribute_id = ea.attribute_id")
        ->joinLeft(array('at_size_value' => 'eav_attribute_option_value'), "at_size.value = at_size_value.option_id AND at_size_value.store_id = 0")
        ->joinLeft(array('ea1' => 'eav_attribute'),"ce.attribute_set_id=ea1.entity_type_id  and ea1.attribute_code='color'")
        ->joinLeft(array('at_color' => 'catalog_product_entity_int'),"ce.entity_id = at_color.entity_id AND at_color.attribute_id = ea1.attribute_id")
        ->joinLeft(array('at_color_value' => 'eav_attribute_option_value'), "at_color.value = at_color_value.option_id AND at_color_value.store_id = 0")
         ->where(
            'parent_item_id IS NULL'
        )->group(
            'order_items.sku'
        )->having(
            'SUM(order_items.qty_refunded) > ?',
            0
        )->order('order.increment_id');
        return $this;
    }
    
    
  
    /**
     * Set store filter to collection
     *
     * @param array $storeIds
     * @return $this
     */
    public function setStoreIds($storeIds)
    {
        if ($storeIds) {
            $this->getSelect()->where('order_items.store_id IN (?)', (array)$storeIds);
        }
        return $this;
    }

    /**
     * Set order
     *
     * @param string $attribute
     * @param string $dir
     * @return $this
     */
    public function setOrder($attribute, $dir = self::SORT_ORDER_DESC)
    {
        if (in_array($attribute, ['orders', 'ordered_qty'])) {
            $this->getSelect()->order($attribute . ' ' . $dir);
        } else {
            parent::setOrder($attribute, $dir);
        }

        return $this;
    }

    /**
     * Prepare between sql
     *
     * @param string $fieldName Field name with table suffix ('created_at' or 'main_table.created_at')
     * @param string $from
     * @param string $to
     * @return string Formatted sql string
     */
    protected function prepareBetweenSql($fieldName, $from, $to)
    {
        return sprintf(
            '(%s BETWEEN %s AND %s)',
            $fieldName,
            $this->getConnection()->quote($from),
            $this->getConnection()->quote($to)
        );
    }
}
