<?php
namespace AttrApi\CustomModule\Observer;

use Magento\Framework\Event\ObserverInterface;

class OrderLoadAfter implements ObserverInterface
{
    protected $_orderExtension;

    public function __construct(\Magento\Sales\Api\Data\OrderExtension $orderExtension)
    {
        $this->_orderExtension = $orderExtension;
    }
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
            $order = $observer->getOrder();

            $extensionAttributes= $order->getExtensionAttributes();
            if ($extensionAttributes === null)
            {
                $extensionAttributes = $this->_orderExtension;
            }
            $deliverycharge = $order->getData('delivery_charge');
            $paymentcharge = $order->getData('payment_charge');
         
            $extensionAttributes->setData('delivery_charge',$deliverycharge);
            $extensionAttributes->setData('payment_charge',$paymentcharge);
           
            $order->setExtensionAttributes($extensionAttributes);
    }
}
