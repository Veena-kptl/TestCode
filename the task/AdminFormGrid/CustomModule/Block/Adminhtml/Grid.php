<?php
namespace AdminFormGrid\CustomModule\Block\Adminhtml;
 
class Grid extends \Magento\Backend\Block\Widget\Container
{
    
    protected $_template = 'grid/view.phtml';
    
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        array $data = []
    ) {
       
        parent::__construct($context, $data);
    }
 
    protected function _prepareLayout()
    {
         
        $addButtonProps = [
            'id' => 'add_new_grid',
            'label' => __('Add New'),
            'class' => 'add',           
            'button_class' => '',
            'class_name' => 'Magento\Backend\Block\Widget\Button\SplitButton',
            'options' => $this->_getAddButtonOptions(),
        ];
        $this->buttonList->add('add_new', $addButtonProps);
 
        $this->setChild(
            'grid',
           $this->getLayout()->createBlock('AdminFormGrid\CustomModule\Block\Adminhtml\Grid\Grid', 'grid.view.grid')
        );
        return parent::_prepareLayout();
    }
 
  
    protected function _getAddButtonOptions()
    {
        
        $splitButtonOptions[] = [
            'label' => __('Add New'),
            'onclick' => "setLocation('" . $this->_getCreateUrl() . "')"
        ]; 
        return $splitButtonOptions;
    }
 
   
    protected function _getCreateUrl()
    {
        return $this->getUrl(
            'blogs/*/new'
        );
    }
 
   
    public function getGridHtml()
    {
        return $this->getChildHtml('grid');
    }
}
