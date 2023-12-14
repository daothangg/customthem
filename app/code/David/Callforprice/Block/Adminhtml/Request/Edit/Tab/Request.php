<?php
namespace David\Callforprice\Block\Adminhtml\Request\Edit\Tab;

class Request extends \Magento\Backend\Block\Widget\Form\Generic implements \Magento\Backend\Block\Widget\Tab\TabInterface
{
   
    protected $_wysiwygConfig;

     protected $_countryOptions;

   
    protected $_booleanOptions;

    public function __construct(
        \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig,
        \Magento\Config\Model\Config\Source\Locale\Country $countryOptions,
        \Magento\Config\Model\Config\Source\Yesno $booleanOptions,
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        array $data = []
    )
    {
        $this->_wysiwygConfig            = $wysiwygConfig;
        $this->_countryOptions           = $countryOptions;
        $this->_booleanOptions           = $booleanOptions;
        parent::__construct($context, $registry, $formFactory, $data);
    }

 
    protected function _prepareForm()
    {
       
        $request = $this->_coreRegistry->registry('david_callforprice_request');
        $form = $this->_formFactory->create(['data' => ['id' => 'edit_form', 'action' => $this->getData('action'), 'method' => 'post']] );
        $form->setHtmlIdPrefix('request_');
        $form->setFieldNameSuffix('request');
        $fieldset = $form->addFieldset(
            'base_fieldset',
            [
                'legend' => __('Request Information'),
                'class'  => 'fieldset-wide'
            ]
        );
        if ($request->getId()) {
            $fieldset->addField(
                'id',
                'hidden',
                ['name' => 'id']
            );
        }
        $fieldset->addField(
            'customer_name',
            'text',
            [
                'name'  => 'customer_name',
                'label' => __('Customer Name'),
                'title' => __('Customer Name'),
                'required' => true,
            ]
        );
        $fieldset->addField(
            'customer_email',
            'text',
            [
                'name'  => 'customer_email',
                'label' => __('Customer Email'),
                'title' => __('Customer Email'),
            ]
        );
		
      
		
		$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
		$groupOptions = $objectManager->get('\Magento\Customer\Model\ResourceModel\Group\Collection')->toOptionArray();
        $fieldset->addField(
            'custom',
            'label',
            [
                'name'  => 'custom',
                'label' => __('Customer Group'),
                'title' => __('Customer Group'),
				'value' => $groupOptions[$request->getCustomerId()]['label']
            ]
        );
        $fieldset->addField(
            'customer_telephone',
            'text',
            [
                'name'  => 'customer_telephone',
                'label' => __('Customer Telephone'),
                'title' => __('Customer Telephone'),
            ]
        );
        $fieldset->addField(
            'product_sku',
            'label',
            [
                'name'  => 'product_sku',
                'label' => __('Product Sku'),
                'title' => __('Product Sku')
            ]
        );
        $fieldset->addField(
            'product_name',
            'text',
          
            [
                'name'  => 'product_name',
                'label' => __('Product Name'),
                'title' => __('Product Name'),
                'style'=>__('pointer-events: none;
                background: #ddd;'),
                
            ]
        );
     
        //có thể sửa comment ở trang edit
        $fieldset->addField(
            'comment',
            'label',//dùng label thì ko đc sửa //
            [
                'name'  => 'comment',
                'label' => __('Comment'),
                'title' => __('Comment'),
            ]
        );
        $fieldset->addField(
            'reply_detail',
            'textarea',
            [
                'name'  => 'reply_detail',
                'label' => __('Request Details Replied'),
                'title' => __('Request Details Replied')
            ]
        );
        $fieldset->addField(
            'status',
            'select',
            [
                'name'  => 'status',
                'label' => __('Status'),
                'title' => __('Status'),
                'values' => array(
					1 => 'New',
					2 => 'Replied'
				),
            ]
        );

        $requestData = $this->_session->getData('david_callforprice_request_data', true);
        if ($requestData) {
            $request->addData($requestData);
        } else {
            if (!$request->getId()) {
                $request->addData($request->getDefaultValues());
            }
        }
        $form->addValues($request->getData());
        $this->setForm($form);
        return parent::_prepareForm();
    }

    
    public function getTabLabel()
    {
        return __('Request');
    }

  
    public function getTabTitle()
    {
        return $this->getTabLabel();
    }

 
    public function canShowTab()
    {
        return true;
    }

  
    public function isHidden()
    {
        return false;
    }
}
