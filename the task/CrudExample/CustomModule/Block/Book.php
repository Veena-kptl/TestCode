<?php

namespace CrudExample\CustomModule\Block;

/**
 * Crudimage content block
 */
class Book extends \Magento\Framework\View\Element\Template
{
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context
    ) {
        parent::__construct($context);
    }

    public function _prepareLayout()
    {
        $this->pageConfig->getTitle()->set(__('Books'));
        
        return parent::_prepareLayout();
    }
}
