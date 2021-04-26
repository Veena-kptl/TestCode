<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace CountdownTimer\TaskModule\Block\Product;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Catalog\Block\Product\Context;
use Magento\Framework\Stdlib\DateTime\TimezoneInterface;

class View extends \Magento\Catalog\Block\Product\View
{
 
    public function isCountdownEnabled()
    {
        return $this->getProduct()->getData('deal_status');
    }
    public function getTile()
    {
       return $this->_scopeConfig->getValue('countdown/general/title');
    }

    public function getCountdownStartDate(){
        return $this->getProduct()->getData('deal_date')." 23:59:59";
    }
    
     public function getCountdownEndDate(){
       $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $objDate = $objectManager->create('Magento\Framework\Stdlib\DateTime\TimezoneInterface');
        return $objDate->date()->format('Y/m/d H:i:s');
    }

    public function getPriceCountDown(){
        if($this->_scopeConfig->getValue('countdown/general/enabled')){
            $currentDate =  date('d-m-Y');
            $todate      =  $this->getProduct()->getData('deal_date');
                if($this->getProduct()->getData('deal_date') != null) {
                    if(strtotime($todate) == strtotime($currentDate)){
                        return true;
                    }   
                }
        }
        return false;
    }
}
