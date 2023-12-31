<?php 

namespace David\Callforprice\Block\Adminhtml;
 
class Request extends \Magento\Backend\Block\Widget\Grid\Container
{
   /**
     * Constructor
     *
     * @return void
     */
   protected function _construct()
    {
        $this->_controller = 'adminhtml_request';
        $this->_blockGroup = 'David_Callforprice';
        $this->_headerText = __('Manage Request');
        $this->_addButtonLabel = __('Add Request');
        parent::_construct();
    }
}
