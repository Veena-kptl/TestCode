<?php
namespace Chapagain\HelloWorld\Setup;
 
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
 
class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup,ModuleContextInterface $context) 
    {
        $setup->startSetup();
        $conn = $setup->getConnection();
 
        $tableName = $setup->getTable('my_custom_table');
        
        if($conn->isTableExists($tableName) != true){
            $table = $conn->newTable($tableName)
                            ->addColumn(
                                'id',
                                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                                null,
                                ['identity'=> true, 'unsigned'=> true, 'nullable'=> false, 'primary'=> true]
                            )
                            ->addColumn(
                                'name',
                                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                                255,
                                ['nullable'=> false, 'default'=> ''],
                                'User Name'
                            )
                            ->addColumn(
                                'email',
                                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                                255,
                                ['nullable'=> false, 'default'=> ''],
                                'Email'
                            )
                            ->addColumn(
                                'dob',
                                \Magento\Framework\DB\Ddl\Table::TYPE_DATE,
                                null,
                                ['nullable'=> false],
                                'Date of Birth'
                            )
                            ->addColumn(
                                'created_at',
                                \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                                null,
                                ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT],
                                'Created At'
                            )->addColumn(
                                'updated_at',
                                \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                                null,
                                ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT_UPDATE],
                                'Updated At'
                            )
                            ->setOption('charset','utf8');
            $conn->createTable($table);
        }
 
        $setup->endSetup();
    }
}

