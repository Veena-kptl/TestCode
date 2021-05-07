<?php 
namespace Chapagain1\HelloWorld\Setup;
 
use Chapagain\HelloWorld\Model\PostFactory;
use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
 
class UpgradeData implements UpgradeDataInterface
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
    
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
 
        /** 
         * \Magento\Framework\DB\Adapter\AdapterInterface 
         */
        $conn = $setup->getConnection(); 
 
        $tableName = $setup->getTable('my_custom_table');
 
        // this code runs while upgrading the module to version 1.0.1
        // upgrade scripts are added after the module is installed
        if (version_compare($context->getVersion(), '1.0.1', '<')) {
            /**
             * Inserting data using the module's Model class
             */
            $data = [
                'name' => 'A A',
                'dob' => '1800-08-08',
                'email' => 'aa@example.com',
                'status' => 0
            ];
            $post = $this->postFactory->create();
            $post->addData($data)->save();
 
            /**
             * Inserting data using the DB Adapter class
             */
            $data = [
                'name' => 'B B',
                'dob' => '1801-08-08',
                'email' => 'bb@example.com',
                'status' => 1
            ];
 
            /**
             * Insert single row of data into the table
             * @param array $data Column-value pairs
             * @return int The number of affected rows.
             */ 
            $conn->insert($tableName, $data);
 
            $data = [
                [
                    'name' => 'C C',
                    'dob' => '1802-08-08',
                    'email' => 'cc@example.com',
                    'status' => 1
                ],
                [
                    'name' => 'D D',
                    'dob' => '1803-08-08',
                    'email' => 'dd@example.com',
                    'status' => 2
                ]
            ];
 
            /**
             * Insert Multiple Rows of data into the table
             * @param array $data Column-value pairs or array of Column-value pairs.
             * @return int The number of affected rows.
             */ 
            $conn->insertMultiple($tableName, $data);
 
            /**
             * In the \Magento\Framework\DB\Adapter\AdapterInterface interface
             * we can find more functions like the following:
             */
 
            /**
             * Update is done if there's a duplicate entry for the unique or primary key
             * @param array $data Column-value pairs or array of column-value pairs.
             * @param array $fields update fields pairs or values
             * @return int The number of affected rows.
             */
            // insertOnDuplicate($table, array $data, array $fields = [])
 
            /**
             * @param  array        $bind  Column-value pairs.
             * @param  mixed        $where UPDATE WHERE clause(s).
             * @return int          The number of affected rows.
             */
            // update($table, array $bind, $where = '')
            // delete($table, $where = '')
 
            /**
             * @param string|\Magento\Framework\DB\Select $sql An SQL SELECT statement.
             * @param mixed $bind Data to bind into SELECT placeholders.
             */
            // query($sql, $bind = [])
            // fetchAll($sql, $bind = [], $fetchMode = null)
            // fetchRow($sql, $bind = [], $fetchMode = null)
            // fetchAssoc($sql, $bind = [])
            // fetchCol($sql, $bind = [])
            // fetchOne($sql, $bind = [])
        }
 
        $setup->endSetup();
    }
}

