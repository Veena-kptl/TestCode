<?php 

namespace CustomersAttributes\TaskModule\Observer;

use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\Event\ObserverInterface;
use Magento\Customer\Api\CustomerRepositoryInterface;

class CustomerRegisterObserver implements ObserverInterface
{
    /**
     * @var \Magento\Customer\Model\CustomerFactory
     */
    protected $customerRepository;

    function __construct(
        CustomerRepositoryInterface $customerRepository,
        \Psr\Log\LoggerInterface $logger
    ) {
        $this->customerRepository = $customerRepository;
        $this->_logger = $logger;
    }


    public function execute(EventObserver  $observer)
    {
        //$this->_logger->info("Observer CustomerRegisterObserver Loaded !");
        $customer = $observer->getEvent()->getCustomer();
 
        if($_POST['father_name']) {
            $customer->setCustomAttribute('father_name', $_POST['father_name']);
 
             $this->customerRepository->save($customer);
        }
        if($_POST['mother_name']) {
             $customer->setCustomAttribute('mother_name', $_POST['mother_name']);
 
             $this->customerRepository->save($customer);
        }
        return $this;
    }
}

