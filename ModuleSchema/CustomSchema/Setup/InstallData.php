<?php

namespace ModuleSchema\CustomSchema\Setup;

use Chapagain\HelloWorld\Model\PostFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
 
class InstallData implements InstallDataInterface
{
    /**
     * @var \Chapagain\HelloWorld\Model\PostFactory
     */
    protected $postFactory;
 
    /**
     * @param \Chapagain\HelloWorld\Model\PostFactory $postFactory
     */
    public function __construct(
        PostFactory $postFactory
    )
    {
        $this->postFactory = $postFactory;
    }
 
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
 
        /** 
         * \Magento\Framework\DB\Adapter\AdapterInterface 
         */
        $conn = $setup->getConnection(); 
 
        $tableName = $setup->getTable('my_custom_table');
 
        /**
         * Inserting data using the module's Model class
         */
        $data = [
            'name' => 'Mukesh Chapagain',
            'dob' => '1900-01-01',
            'email' => 'mukesh@example.com'
        ];
 
        $post = $this->postFactory->create();
        $post->addData($data)->save();
 
 
        /**
         * Inserting data using the DB Adapter class
         */
        $data = [
            'name' => 'Muk Cha',
            'dob' => '1900-05-05',
            'email' => 'mukcha@example.com'
        ];
 
        /**
         * Insert single row of data into the table
         * 
         * @param array $data Column-value pairs
         * @return int The number of affected rows.
         */ 
        $conn->insert($tableName, $data);
 
        $setup->endSetup();
    }
}

