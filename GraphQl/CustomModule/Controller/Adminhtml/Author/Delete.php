<?php

namespace GraphQl\CustomModule\Controller\Adminhtml\Author;
use Magento\Backend\App\Action\Context;
use GraphQl\CustomModule\Model\Author;

/**
 * Class Delete
 * @package GraphQl\CustomModule\Controller\Adminhtml\Author
 */
class Delete extends \Magento\Backend\App\Action
{
	/**
	 * 
	 * @var GraphQl\CustomModule\Model\Author
	 */
	protected $author;
	
	/**
     * @param Context $context
     * @param Author $author
     */
	public function __construct(
			Context $context,
			Author $author
	) {
		parent::__construct($context);
		$this->author = $author;
	}
	
	/**
	 * Delete action
	 *
	 * @return \Magento\Framework\Controller\ResultInterface
	 */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
			
        if (!$id) {
            $this->messageManager->addError(__('Unable to proceed. Please, try again.'));
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('*/*/index', array('_current' => true));
        }
        try{
        	$this->author->load($id);
            $this->author->delete();
            $this->messageManager->addSuccess(__('Author Has been deleted !'));
        } catch (Exception $e) {
            $this->messageManager->addError(__('Error while trying to delete Author: '));
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('*/*/index', array('_current' => true));
        }
        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('*/*/index', array('_current' => true));
    }
}

