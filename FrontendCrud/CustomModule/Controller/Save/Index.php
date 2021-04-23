<?php

namespace FrontendCrud\CustomModule\Controller\Save;

use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\Action;
use FrontendCrud\CustomModule\Model\OsFactory;
use Magento\Customer\Model\Session;

class Index extends Action {

    protected $_request;
    protected $_customerSession;

    public function __construct(Context $context, Session $customerSession) {

        $this->_customerSession = $customerSession;
        return parent::__construct($context);
    }

    public function execute() {

        $post = $this->_request->getParams();
        $entity_id = $this->_customerSession->getCustomer()->getId();
        
        try {

            if (empty($post['title'])) {
                throw new Exception('Enter values!');
            }

            $resultRedirect = $this->resultRedirectFactory->create();
            $post = $this->_request->getParams();
            $model = $this->_objectManager->create('FrontendCrud\CustomModule\Model\Os');
            $model->setTitle($post['title']);
            $model->setDescription($post['description']);
            $model->setCreationDate(date('Y-m-d'));
            $model->setEntityId($entity_id);
            $model->setIsActive('1');

            if ($model->save()) {
                $this->messageManager->addSuccess(__('Thanks for contacting us with your comments and questions. We\'ll respond to you very soon.'));
                $resultRedirect->setUrl($this->_redirect('customer/create'));
            } else {
                $this->messageManager->addError($e->getMessage());
            }
        } catch (Exception $e) {

            $this->messageManager->addError($e->getMessage());
            $resultRedirect->setUrl($this->_redirect('customer/create'));
        }
    }

}

