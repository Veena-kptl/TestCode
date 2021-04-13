<?php


namespace BlockController\CustomModule\Controller\Product;

class View extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory    = $resultPageFactory;
        return parent::__construct($context);
    }

    /**
     * View action
     *
     * @return \Magento\Framework\View\Result\PageFactory
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
        // it helps to render the layout
        $resultPage = $this->resultPageFactory->create();
        return $resultPage;
    }
}

