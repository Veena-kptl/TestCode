<?php

namespace CustomBlocks\TaskModule\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchVersionInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Cms\Model\BlockFactory;
/**
 * Class AddNewCmsStaticBlock
 * @package CustomBlocks\TaskModule\Setup\Patch\Data
 */
class AddNewCmsStaticBlock implements DataPatchInterface, PatchVersionInterface
{
    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    /**
     * @var BlockFactory
     */
    private $blockFactory;

    /**
     * AddAccessViolationPageAndAssignB2CCustomers constructor.
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param PageFactory $blockFactory
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        BlockFactory $blockFactory
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->blockFactory = $blockFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function apply()
    {
        $newCmsStaticBlock = [[
            'title' => 'My Custom Content Block',
            'identifier' => 'content-block',
            'content' => '<div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse mauris tortor, 
                        rhoncus at diam ac, aliquet egestas elit. Integer varius, ipsum et imperdiet scelerisque, 
                        lorem magna feugiat arcu, sed rhoncus velit magna a velit.</div>',
            'is_active' => 1,
            'stores' => \Magento\Store\Model\Store::DEFAULT_STORE_ID
        ],
        [
            'title' => 'My Custom Left Block',
            'identifier' => 'left-block',
            'content' => '<div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse mauris tortor, 
                        rhoncus at diam ac, aliquet egestas elit. Integer varius, ipsum et imperdiet scelerisque, 
                        lorem magna feugiat arcu, sed rhoncus velit magna a velit.</div>',
            'is_active' => 1,
            'stores' => \Magento\Store\Model\Store::DEFAULT_STORE_ID
        ],
        [
            'title' => 'My Custom Right Block',
            'identifier' => 'right-block',
            'content' => '<div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse mauris tortor, 
                        rhoncus at diam ac, aliquet egestas elit. Integer varius, ipsum et imperdiet scelerisque, 
                        lorem magna feugiat arcu, sed rhoncus velit magna a velit.</div>',
            'is_active' => 1,
            'stores' => \Magento\Store\Model\Store::DEFAULT_STORE_ID
        ]];

        $this->moduleDataSetup->startSetup();

        /** @var \Magento\Cms\Model\Block $block */
        foreach($newCmsStaticBlock as $cmsBlock)
        {
            $block = $this->blockFactory->create();
            $block->setData($cmsBlock)->save();
        }

        $this->moduleDataSetup->endSetup();
    }

    /**
     * {@inheritdoc}
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public static function getVersion()
    {
        return '2.0.0';
    }

    /**
     * {@inheritdoc}
     */
    public function getAliases()
    {
        return [];
    }
}
