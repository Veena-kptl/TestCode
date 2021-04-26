<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace CountdownTimer\TaskModule\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

/**
* @codeCoverageIgnore
*/
class InstallData implements InstallDataInterface
{
    /**
     * Eav setup factory
     * @var EavSetupFactory
     */
    private $eavSetupFactory;

    /**
     * Init
     * @param EavSetupFactory $eavSetupFactory
     */
    public function __construct(\Magento\Eav\Setup\EavSetupFactory $eavSetupFactory)
    {
        $this->eavSetupFactory = $eavSetupFactory;
    }

    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $eavSetup = $this->eavSetupFactory->create();
        $eavSetup->removeAttribute(\Magento\Catalog\Model\Product::ENTITY, 'deal_status');
        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'deal_status',
            [
                'group' => 'Daily Deals',
                'type' => 'int',
                'label' => 'Deal status',
                'input' => 'select',
                'backend' => '',
                'frontend' => '',
                'source' => 'CountdownTimer\TaskModule\Model\Attribute\Source\Status',
                'required' => false,
                'sort_order' => 50,
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
                'is_used_in_grid' => false,
                'is_visible_in_grid' => false,
                'is_filterable_in_grid' => false,
                'visible' => true,
                'is_html_allowed_on_front' => true,
                'visible_on_front' => true
            ]
        );

        $eavSetup->removeAttribute(\Magento\Catalog\Model\Product::ENTITY, 'deal_date');
        $eavSetup->addAttribute(\Magento\Catalog\Model\Product::ENTITY, 'deal_date', [
            'group' => 'Daily Deals',
            'type' => 'varchar',
            'backend' => '',
            'frontend' => '',
            'sort_order' => 220,
            'label' => 'Date of Deal',
            'input' => 'date',
            'class' => '',
            'required' => false,
            'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
            'is_used_in_grid' => false,
                'is_visible_in_grid' => false,
                'is_filterable_in_grid' => false,
                'visible' => true,
                'is_html_allowed_on_front' => true,
                'visible_on_front' => true
        ]);
    }
}
