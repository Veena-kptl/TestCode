<?php

namespace LoginRestriction\TaskModule\Controller\Adminhtml\Index;

use LoginRestriction\TaskModule\Model\Ip as Ip;

class Delete extends \Magento\Backend\App\Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'LoginRestriction_TaskModule::ip';

    /**
     * Delete action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('ip_id'); 

        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            try {
                // init model and delete
                $model = $this->_objectManager->create(\LoginRestriction\TaskModule\Model\Ip::class);
                $model->load($id);
                $model->delete();
                // display success message
                $this->messageManager->addSuccess(__('IP address has been deleted.'));
                // go to grid
                
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                
                // display error message
                $this->messageManager->addError($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['st_id' => $id]);
            }
        }
        // display error message
        $this->messageManager->addError(__('We can\'t find entity to delete.'));
        // go to grid
        return $resultRedirect->setPath('*/*/');
    
    }
    
}
