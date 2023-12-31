<?php

namespace David\Callforprice\Helper;

class Email extends \Magento\Framework\App\Helper\AbstractHelper
{
    
    protected $_scopeConfig;
 
    
    protected $_storeManager;
 
   
    protected $inlineTranslation;
 
  
    protected $_transportBuilder;
     
   
    protected $temp_id;
 
    
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\Translate\Inline\StateInterface $inlineTranslation,
        \Magento\Framework\Mail\Template\TransportBuilder $transportBuilder
    ) {
        $this->_scopeConfig = $context;
        parent::__construct($context);
        $this->_storeManager = $storeManager;
        $this->inlineTranslation = $inlineTranslation;
        $this->_transportBuilder = $transportBuilder; 
    }
 
   
    protected function getConfigValue($path, $storeId)
    {
        return $this->scopeConfig->getValue(
            $path,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }
 
   
    public function getStore()
    {
        return $this->_storeManager->getStore();
    }
 
   
    public function getTemplateId($xmlPath)
    {
        return $this->getConfigValue($xmlPath, $this->getStore()->getStoreId());
    }
 
    
    public function generateTemplate($emailTemplateVariables,$senderInfo,$receiverInfo)
    {
        $template =  $this->_transportBuilder->setTemplateIdentifier($this->temp_id)
                ->setTemplateOptions(
                    [
                        'area' => \Magento\Framework\App\Area::AREA_FRONTEND, /* here you can defile area and
                                                                                 store of template for which you prepare it */
                        'store' => $this->_storeManager->getStore()->getId(),
                    ]
                )
                ->setTemplateVars(['data' => $emailTemplateVariables])
                ->setFrom($senderInfo)
                ->addTo($receiverInfo);
                /* ->addTo($receiverInfo['email'],$receiverInfo['name']); */
        return $this;        
    }
 
    public function sendMail($templateId, $emailTemplateVariables, $senderInfo, $receiverInfo)
    {	
		// $writer = new \Zend\Log\Writer\Stream(BP . '/var/log/callforprice.log');
		// $logger = new \Zend\Log\Logger();
		// $logger->addWriter($writer);
        $this->temp_id = $templateId;
        $this->inlineTranslation->suspend();    
		try{
			$postObject = new \Magento\Framework\DataObject();
			$postObject->setData($emailTemplateVariables);
			$receiverInfo = explode(",",$receiverInfo);
			$this->generateTemplate($postObject,$senderInfo,$receiverInfo);    
			$transport = $this->_transportBuilder->getTransport();
			$transport->sendMessage();     
		}catch(\Exception $e){
			// $logger->info($e);
		}		
        $this->inlineTranslation->resume();
    }
 
}
