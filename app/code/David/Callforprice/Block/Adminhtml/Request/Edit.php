<?php

namespace David\Callforprice\Block\Adminhtml\Request;

class Edit extends \Magento\Backend\Block\Widget\Form\Container
{
    protected $_coreRegistry;

    public function __construct(
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Backend\Block\Widget\Context $context,
        array $data = []
    )
    {
        $this->_coreRegistry = $coreRegistry;
        parent::__construct($context, $data);
    }

   
    protected function _construct()
    {
        $this->_objectId = 'id';
        $this->_blockGroup = 'David_Callforprice';
        $this->_controller = 'adminhtml_request';
        parent::_construct();
		$this->buttonList->add('reply',[
            'label' 	=> __('Reply'),
			'class'     => 'save',
			'onclick'   => 'replyAndContinueEdit()',
			 -110
        ]);
        $this->buttonList->update('save', 'label', __('Save Request'));
        $this->buttonList->add(
            'save-and-continue',
            [
                'label' => __('Save and Continue Edit'),
                'class' => 'save',
                'data_attribute' => [
                    'mage-init' => [
                        'button' => [
                            'event' => 'saveAndContinueEdit',
                            'target' => '#edit_form'
                        ]
                    ]
                ]
            ],
            -100
        );
        $this->buttonList->update('delete', 'label', __('Delete Request'));
		$this->_formScripts[] = " function replyAndContinueEdit(){
			var hidden = document.createElement('input');
			hidden.type = 'hidden';
			hidden.name = 'request[reply]';
			hidden.value = '1';
			var f = document.getElementById('edit_form');
			f.appendChild(hidden);
			f.submit();
        }
		";
    }
    
    public function getHeaderText()
    {
       
        $request = $this->_coreRegistry->registry('david_callforprice_request');
        if ($request->getId()) {
            return __("Edit Request '%1'", $this->escapeHtml($request->getName()));
        }
        return __('New Request');
    }
}
