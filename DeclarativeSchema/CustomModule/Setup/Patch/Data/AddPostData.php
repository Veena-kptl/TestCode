<?php

namespace DeclarativeSchema\CustomModule\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class AddPostData implements DataPatchInterface
{
    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
    }

    /**
     * @return string[]
     */
    public static function getDependencies()
    {
        return [AddCategoryData::class];
    }

    /**
     * @return string[]
     */
    public function getAliases()
    {
        return [];
    }

    /**
     * @return $this
     */
    public function apply()
    {
        $adapter = $this->moduleDataSetup->getConnection()->startSetup();
        /** @var \Magento\Framework\DB\Select $result */
        $select = $adapter->select()->from('sample_category');
        $result = $adapter->fetchRow($select);
        if (is_array($result) && count($result) > 0 && key_exists('category_id', $result)) {
            $categoryId = $result['category_id'];
            $adapter->insert('sample_post', ['title' => 'One', 'category_id' => $categoryId, 'content' => 'Some text',]);
            $adapter->insert('sample_post', ['title' => 'Two', 'category_id' => $categoryId, 'content' => 'Some text example',]);
        }

        $this->moduleDataSetup->getConnection()->endSetup();

        return $this;
    }
}

