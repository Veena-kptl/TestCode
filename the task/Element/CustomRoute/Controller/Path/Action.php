<?php
/**
* @package     
* @version
* @author      Human-Element, Inc. <info@human-element.com>
* @copyright   Copyright 2016 Human-Element, Inc.
**/

namespace Element\CustomRoute\Controller\Path;

class Action extends \Magento\Framework\App\Action\Action 
{
	
    protected $_context;
    protected $_pageFactory;
    protected $_jsonEncoder;
    protected $_orderHelper;
    
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\Json\EncoderInterface $encoder,
        \Element\CustomRoute\Helper\OrderData $orderHelper,
        \Magento\Framework\View\Result\PageFactory $pageFactory
    ) {
        $this->_context = $context;
        $this->_pageFactory = $pageFactory;
        $this->_orderHelper = $orderHelper; 
		$this->_jsonEncoder = $encoder;        
        parent::__construct($context);
    }
    
	/**
	 * Takes the place of the M1 indexAction. 
	 * Now, every action has an execute
	 *
	 ***/
    public function execute() 
    {    	
    	$oid = $this->getRequest()->getParam('oid');
        $orderData = ['response'=>null];
        if ($oid) {
            $orderData['response'] = $this->_orderHelper->getOrderInfo($oid);
        } else {
            $orderData = array('error' => 'The order does not exist or was not provided');
        }

        $this->getResponse()->representJson($this->_jsonEncoder->encode($orderData));
    	return;
    }
}
