<?php

namespace RouterHtml\CustomRoute\Controller\Path;

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
 
        // Return Raw Text or HTML data
        // $result->setContents('Hello World');
        $result->setContents('<strong>Hello World</strong>');
 
        return $result;
    }
}
