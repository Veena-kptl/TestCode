<?php
    namespace  OrderApi\CustomApi\Model;    
    
    
    use OrderApi\CustomApi\Api\CustomerOrderInterface;
    use Magento\Sales\Model\Order;
    
    class CustomerOrder implements CustomerOrderInterface
    {
        private $order;
        /**
         * CustomerOrder constructor.
         *
         * @param Order $order
         */
        public function __construct(
            Order $order
        ) {
            $this->order = $order;
        }
    
        /**
         * Returns orders data to user
         *
         * @api
         * @param  string $id customer id.
         * @return return order array collection.
         */
        public function getList($id)
        {
            $order = $this->order->getCollection()->addAttributeToFilter('customer_id', $id);
            $data=[];
            $i=0;
            foreach ($order as $orderDetails) {
                $data[$i]['increment_id']=$orderDetails->getIncrementId();
                $data[$i]['created_at']=$orderDetails->getCreatedAt();
                $data[$i]['ship_to']=$orderDetails->getShippingAddress()->getData();
                $data[$i]['grand_total']=$orderDetails->getGrandTotal();
                $data[$i]['status']=$orderDetails->getStatus();
                $data[$i]['id']=$orderDetails->getId();
                $i++;
            }
            return $data;
        }
    
       
    }
