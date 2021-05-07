<?php

namespace UpdateStock\TaskModule\Block;

/**
 * Crudimage content block
 */
class Stock extends \Magento\Framework\View\Element\Template
{
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context
    ) {
        parent::__construct($context);
    }

    public function _prepareLayout()
    {
        $this->pageConfig->getTitle()->set(__('Update Stock'));
        
        return parent::_prepareLayout();
    }
}
