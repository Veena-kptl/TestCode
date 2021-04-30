<?php

namespace LoginRestriction\TaskModule\Model;
 
use LoginRestriction\TaskModule\Model\ResourceModel\Ip\Collection; 
use Magento\Framework\HTTP\PhpEnvironment\RemoteAddress;
use LoginRestriction\TaskModule\Model\IpFactory;

class Observer implements \Magento\Framework\Event\ObserverInterface
{
   
    protected $ipCollection;
     
    protected $remoteAddress;
   
    protected $_ipFactory;
    
    protected $_logger;
    protected $_storeManager;
    protected $messageManager;
   
    public function __construct(
        Collection $ipCollection,
        IpFactory $ipFactory,
        RemoteAddress $remoteAddress,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\Message\ManagerInterface $messageManager
    ) {
        $this->_ipFactory = $ipFactory;
        $this->ipCollection = $ipCollection;
        $this->remoteAddress = $remoteAddress; 
        $this->_logger = $logger;
        $this->_storeManager = $storeManager;
        $this->messageManager = $messageManager;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        # check if user is logged in
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $customerSession = $objectManager->get('Magento\Customer\Model\Session');
        if(!$customerSession->isLoggedIn())
        {
            $request = $objectManager->get('Magento\Framework\App\Request\Http');
            //get instance for URL interface
            /** @var \Magento\Framework\UrlInterface $urlInterface */
            $urlInterface = $objectManager->get('Magento\Framework\UrlInterface');
            // URL to redirect to
            $url = $urlInterface->getUrl('customer/account/login');
            $ip = $this->remoteAddress->getRemoteAddress();
            $ipModel = $this->_ipFactory->create();
            $rowData = $this->ipCollection->addFieldToFilter('ip_address', $ip)->load();
            $data = $rowData->getData();
            if($data[0]['ip_id'] == "" || empty($data[0]['ip_id']))
            {
                $ipModel->setData('ip_address', $ip);
                $ipModel->setData('ip_status', 1);
                $ipModel->save();
                $observer->getControllerAction()
                        ->getResponse()
                        ->setRedirect($url);
            }
            else
            {
                if($data[0]['ip_status'] == "0")
                {
                    $url=$urlInterface->getUrl();
                    //echo "<pre>"; var_dump($url);die();
                    $observer->getControllerAction()
                        ->getResponse()
                        ->setRedirect($url);
                    $this->messageManager->addError(__('You are Not allowed to logged in.'));
                }
            }
            
            
        }
    }
}
