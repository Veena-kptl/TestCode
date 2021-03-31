<?php

namespace RouterRaw\CustomRoute\Controller\Path;

use Magento\Framework\UrlFactory;
 
class Action extends \Magento\Framework\App\Action\Action
{
        /**
         * @var \Magento\Framework\View\Result\PageFactory
         */
        protected $resultPageFactory;
 
        /**
         * @var \Magento\Framework\UrlFactory
         */
        protected $urlFactory;
       
        /**
         * @var \Magento\Framework\Controller\Result\RawFactory
         */
        protected $resultRawFactory;
       
        /**
         * @param \Magento\Framework\App\Action\Context $context
         * @param \Magento\Framework\View\Result\PageFactory resultPageFactory
         * @param \Magento\Framework\Controller\Result\RawFactory $resultRawFactory
         */
        public function __construct(
            \Magento\Framework\App\Action\Context $context,
            \Magento\Framework\View\Result\PageFactory $resultPageFactory,
            \Magento\Framework\Controller\Result\RawFactory $resultRawFactory,
            UrlFactory $urlFactory
        )
        {
            $this->resultPageFactory    = $resultPageFactory;
            $this->resultRawFactory     = $resultRawFactory;
            $this->urlModel             = $urlFactory->create();
 
            parent::__construct($context);
        }
    /**
     * Example for returning Raw Text data
     *
     * @return string
     */
    public function execute()
    {
        $result = $this->resultRawFactory->create();
 
        // Return XML data
        $result->setHeader('Content-Type', 'text/xml');
        $result->setContents('<user>
                                <name>Mukesh Chapagain</name>
                                <country>Nepal</country>
                            </user>');
 
        return $result;
    }
}
