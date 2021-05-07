<?php
namespace AffectedProducts\TaskModule\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{
	public function upgrade( SchemaSetupInterface $setup, ModuleContextInterface $context ) {
		$installer = $setup;

		$installer->startSetup();

		if(version_compare($context->getVersion(), '1.2.0', '<')) {
			$installer->getConnection()->addColumn(
				$installer->getTable( 'catelogrule' ),
				'ptoduct_ids',
				[
					'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
					'nullable' => true,
					'length' => '500',
					'comment' => 'Product Ids',
					'after' => 'discount_amount'
				]
			);
		}



		$installer->endSetup();
	}
}
