<?php
namespace CrudExample\CustomModule\Controller\Adminhtml\Index;

use Magento\Cms\Controller\Adminhtml\Block;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;

class NewAction extends Block
{
    const ADMIN_RESOURCE = 'CrudExample_CustomModule::review';

    /**
     * @return ResponseInterface|ResultInterface|void
     */
    public function execute()
    {
        $this->_forward('edit');
    }
}
