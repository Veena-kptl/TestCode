<?php

namespace CrudExample\CustomModule\Setup;

use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements InstallSchemaInterface
{
    /**
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     * @throws \Zend_Db_Exception
     */
    public function install(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $setup->startSetup();
        $this->_createCategoryTable($setup);
        $setup->endSetup();
    }

    /**
     * @param SchemaSetupInterface $setup
     * @throws \Zend_Db_Exception
     */
    private function _createCategoryTable($setup)
    {
        /** @var \Magento\Framework\DB\Adapter\AdapterInterface $connection */
        $connection = $setup->getConnection();
        $tableName = 'test_book';

        if (!$setup->tableExists($tableName)) {
            $table = $connection->newTable($setup->getTable($tableName))
                ->addColumn(
                    'id', Table::TYPE_INTEGER, null,
                    [
                        'identity' => true,
                        'nullable' => false,
                        'primary'  => true,
                        'unsigned' => true,
                    ], 'ID'
                )
                ->addColumn(
                    'book_type', Table::TYPE_TEXT, 255, ['nullable' => false],
                    'Book Type'
                )
                ->addColumn(
                    'name', Table::TYPE_TEXT, 255, ['nullable' => false],
                    'Name'
                )
                ->addColumn(
                    'language', Table::TYPE_TEXT, 500, ['nullable' => false],
                    'Languages'
                )
                ->addColumn(
                    'color', Table::TYPE_TEXT, 255, ['nullable' => false],
                    'Color'
                )
                ->addColumn(
                    'content', Table::TYPE_TEXT, 2000, ['nullable' => false],
                    'Review text'
                )
                ->addColumn(
                    'author', Table::TYPE_TEXT, 255, ['nullable' => false],
                    'Author'
                )
                ->addColumn(
                    'status', Table::TYPE_TINYINT, null, ['nullable' => false, 'unsigned' => true, 'default' => 0],
                    'Status'
                )
                ->addColumn(
                    'rating', Table::TYPE_SMALLINT, null, ['nullable' => false, 'unsigned' => true, 'default' => 0],
                    'Rating'
                )
                ->addColumn(
                    'created_at',
                    Table::TYPE_TIMESTAMP,
                    null,
                    ['nullable' => false, 'default' => Table::TIMESTAMP_INIT],
                    'Creation Time'
                )
                ->addColumn(
                    'updated_at',
                    Table::TYPE_TIMESTAMP,
                    null,
                    ['nullable' => false, 'default' => Table::TIMESTAMP_INIT_UPDATE],
                    'Modification Time'
                )
                ->addIndex(
                    $setup->getIdxName($tableName, ['book_type'], AdapterInterface::INDEX_TYPE_INDEX),
                    ['book_type'],
                    ['type' => AdapterInterface::INDEX_TYPE_INDEX]
                )
                ->addIndex(
                    $setup->getIdxName($tableName, ['status'], AdapterInterface::INDEX_TYPE_INDEX),
                    ['status'],
                    ['type' => AdapterInterface::INDEX_TYPE_INDEX]
                )
                ->setComment('Product Book');

            $connection->createTable($table);
        }
    }
}
