<?php

namespace LoginRestriction\TaskModule\Setup;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * @codeCoverageIgnore
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
    * {@inheritdoc}
    * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
    */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
          /**
          * Create table 'ip_address'
          */
          $table = $setup->getConnection()
              ->newTable($setup->getTable('ip_address'))
              ->addColumn(
                  'ip_id',
                  \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                  null,
                  ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                  'Table ID'
              )
              ->addColumn(
                  'ip_address',
                  \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                  255,
                  ['nullable' => false, 'default' => ''],
                    'Message'
              )
                ->addColumn(
                  'ip_status',
                  \Magento\Framework\DB\Ddl\Table::TYPE_TINYINT,
                  null,
                  ['nullable' => false],
                    'IP Status'
              )->setComment("Ip address table");
          $setup->getConnection()->createTable($table);
      }
}
