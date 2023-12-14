<?php
namespace David\Callforprice\Block\Adminhtml\Request\Edit;

class Form extends \Magento\Backend\Block\Widget\Form\Generic
{
	
    protected $_systemStore;
	
	public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Store\Model\System\Store $systemStore,
        array $data = []
    ) {
        $this->_systemStore = $systemStore;
        parent::__construct($context, $registry, $formFactory, $data);
    }
	
	/**
     * Init form
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('request_form');
        $this->setTitle(__('Request Information'));
    }
	
    
    protected function _prepareForm()
    {
        $model = $this->_coreRegistry->registry('david_callforprice_request');
		
        $form = $this->_formFactory->create(['data' => ['id' => 'edit_form', 'action' => $this->getData('action'), 'method' => 'post']] );
		$form->setHtmlIdPrefix('request_');
		$form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);
        return parent::_prepareForm();
    }
}
