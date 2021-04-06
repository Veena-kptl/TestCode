<?php

namespace EAVModule\CustomModule\Setup;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use EAVModule\CustomModule\Setup\HelloWorldSetupFactory;
class InstallData implements InstallDataInterface
{
    /**
     * HelloWorld setup factory
     *
     * @var HelloWorldSetupFactory
     */
    protected $helloworldSetupFactory;
    /**
     * Init
     *
     * @param HelloWorldSetupFactory $helloworldSetupFactory
     */
    public function __construct(
        HelloWorldSetupFactory $helloworldSetupFactory
    ) {
        $this->helloworldSetupFactory = $helloworldSetupFactory;
    }
    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        /** @var HelloWorldSetup $helloworldSetup */
        $helloworldSetup = $this->helloworldSetupFactory->create(['setup' => $setup]);
        $setup->startSetup();
        $helloworldSetup->installEntities();
        $entities = $helloworldSetup->getDefaultEntities();
        foreach ($entities as $entityName => $entity) {
            $helloworldSetup->addEntityType($entityName, $entity);
        }
        $setup->endSetup();
    }
}
