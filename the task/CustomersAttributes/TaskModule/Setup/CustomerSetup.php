<?php

namespace CustomersAttributes\TaskModule\Setup;

use Magento\Eav\Model\Config;
use Magento\Eav\Model\Entity\Setup\Context;
use Magento\Eav\Setup\EavSetup;
use Magento\Framework\App\CacheInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Eav\Model\ResourceModel\Entity\Attribute\Group\CollectionFactory;

class CustomerSetup extends EavSetup {

	protected $eavConfig;

	public function __construct(
		ModuleDataSetupInterface $setup,
		Context $context,
		CacheInterface $cache,
		CollectionFactory $attrGroupCollectionFactory,
		Config $eavConfig
		) {
		$this -> eavConfig = $eavConfig;
		parent :: __construct($setup, $context, $cache, $attrGroupCollectionFactory);
	} 

	public function installAttributes($customerSetup) {
		$this -> installCustomerAttributes($customerSetup);
		$this -> installCustomerAddressAttributes($customerSetup);
	} 

	public function installCustomerAttributes($customerSetup) {
		$customerSetup -> addAttribute(\Magento\Customer\Model\Customer::ENTITY,
			'father_name',
			[
			'label' => 'Your Father Name',
			'system' => 0,
			'position' => 96,
            'sort_order' =>96,
            'visible' =>  true,
			'note' => '',
			'type' => 'varchar',
            'input' => 'text',
			'user_defined' => true,
            'is_used_in_grid' => 1,
            'is_visible_in_grid' => 1,
            'is_filterable_in_grid' => 1,
            'is_searchable_in_grid' => 1,
			]
			);

		$customerSetup->getEavConfig()->getAttribute('customer', 'father_name')->setData('is_user_defined',1)
										 ->setData('is_required',0)
										 ->setData('default_value','')
										 ->setData('used_in_forms', ['adminhtml_customer','checkout_register','adminhtml_checkout']) 
										 ->save();
        $customerSetup -> addAttribute(\Magento\Customer\Model\Customer::ENTITY,
			'mother_name',
			[
			'label' => 'Your Mother Name',
			'system' => 0,
			'position' => 95,
            'sort_order' =>95,
            'visible' =>  true,
			'note' => '',
			'type' => 'varchar',
            'input' => 'text',
			'user_defined' => true,
            'is_used_in_grid' => 1,
            'is_visible_in_grid' => 1,
            'is_filterable_in_grid' => 1,
            'is_searchable_in_grid' => 1,
			]
			);

		$customerSetup->getEavConfig()->getAttribute('customer', 'mother_name')->setData('is_user_defined',1)
										 ->setData('is_required',0)
										 ->setData('default_value','')
										 ->setData('used_in_forms', ['adminhtml_customer','checkout_register','adminhtml_checkout']) 
										 ->save();
	} 

	public function installCustomerAddressAttributes($customerSetup) {
			
	} 

	public function getEavConfig() {
		return $this -> eavConfig;
	} 
} 

