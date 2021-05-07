<?php
namespace Chapagain1\HelloWorld\Setup;
 
use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
 
class UpgradeSchema implements UpgradeSchemaInterface
{
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context) 
    {
        $installer = $setup; 
        $installer->startSetup();
        $conn = $setup->getConnection();
 
        // this code runs while upgrading the module to version 1.0.1
        // upgrade scripts are added after the module is installed
        if(version_compare($context->getVersion(), '1.0.1', '<')) {
            $installer->getConnection()->addColumn(
                $installer->getTable( 'my_custom_table' ),
                'status',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                    'nullable' => false,
                    'unsigned' => true,
                    'default' => '0',
                    'comment' => 'Status',
                    'after' => 'dob'
                ]
            );
        }
 
        $installer->endSetup();
    }
}
