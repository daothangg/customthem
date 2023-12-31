<?php
namespace David\Callforprice\Controller\Form;
class Submit extends \Magento\Framework\App\Action\Action
{
    protected $_requestFactory;
    protected $_coreRegistry;
    protected $_resultRedirectFactory;
    protected $_helper;
    protected $_transportBuilder;
	protected $_resultPageFactory;
	protected $_scopeConfig;
	protected $_json;
	protected $_storeManager;
	protected $inlineTranslation;
	protected $_escaper;
   
    public function __construct(
        \Magento\Framework\App\Action\Context$context,
		\Magento\Framework\View\Result\PageFactory $resultPageFactory, 
		\David\Callforprice\Helper\Data $helper,
		\Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
		\Magento\Framework\Controller\Result\JsonFactory $json,
		\Magento\Store\Model\StoreManagerInterface $storeManager,
		\Magento\Framework\Mail\Template\TransportBuilder $transportBuilder,
		\Magento\Framework\Translate\Inline\StateInterface $inlineTranslation,
		\Magento\Framework\Escaper $escaper
    )
    {
        $this->_helper 				  = $helper;
        $this->_scopeConfig 		  = $scopeConfig;
        $this->_resultPageFactory 	  = $resultPageFactory;
        $this->_json 	 			  = $json;
        $this->_storeManager 	 	  = $storeManager;
		$this->_transportBuilder 	  = $transportBuilder;
		$this->inlineTranslation 	  = $inlineTranslation;
		$this->_escaper 	 		  = $escaper;
        $this->_scopeConfig 		  = $scopeConfig;
        // $this->_resultPageFactory 	  = $resultPageFactory;
		// $this->_helper 				  = $helper;
        // $this->_json 	 			  = $json;
        parent::__construct($context);
    }

    public function execute()
    {
		$message  = "";
		$postData = $this->getRequest()->getPost();
        $writer = new \Zend_Log_Writer_Stream(BP . '/var/log/custom.log');
        $logger = new \Zend_Log();
        $logger->addWriter($writer);
        $logger->info('text message');

		if ($postData){
			$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
			$callData = $objectManager->create('David\Callforprice\Model\Request');
            $name = $postData['name'];
            $email = $postData['email'];
            $telephone = $postData['telephone'];
            $productId = $postData['product_id'];
            $comment = $postData['comment'];
			$product = $objectManager->get('Magento\Catalog\Model\Product')->load($productId);
            $image	  = $objectManager->get('Magento\Catalog\Block\Product\ListProduct');
            $callData->setCustomerName($name)
                ->setCustomerEmail($email)
                ->setCustomerTelephone($telephone)
                ->setComment($comment)
				->setStatus(1) // Set Status to New
                ->setProductId($productId);
            $callData->setProductName($product->getName());
            
            $callData->setProductSku ($product->getSku());
         
            $detail =  "<p>" . __('Product Name') . ": <a href=". $product->getProductUrl() . ">".  $product->getName()."</a> </p>"; 
            $detail .="<p >".__('Product Image').":".$image->getImage($product, 'category_page_list')->toHtml()."</p>";
            $detail .= "<p>" . __('Product Sku') . ": ". $product->getSku()." </p> ";
            $detail .="<p>".__('Price').":".$product->getPrice()."</p>";
            $detail .= "<p>" . __('Note*') . ": ". $comment ." </p> ";
            $logger->info(print_r($postData,true));
            try
            {
                $callData->save();
				$data = array();
				$data['name'] = $name;
				$data['email'] = $email;
				$data['telephone'] = $telephone;
				$data['comment'] = $detail;
				$data['status']= __('New');
				
				$storeId    = $this->_storeManager->getStore()->getId();
				$templateId = $this->_helper->getConfigValue('callforprice_settings/callforprice/email_template');
				$receiverInfo  = $this->_helper->getConfigValue('callforprice_settings/callforprice/email_to');
				$senderInfo = $this->_helper->getConfigValue('callforprice_settings/callforprice/email_from');
				
				/* call send mail method from helper or where you define it*/ 
				$objectManager->get('David\Callforprice\Helper\Email')->sendMail($templateId,$data,$senderInfo,$receiverInfo);
				
                $success =true; 
                $message = __('Your request is accepted.');
            }
            catch (\Exception $e)
            {
                $success =false;
                $message = __('Your Request is Not Sent.');
            }
			$resultJson = $this->_json->create();
			return $resultJson->setData(array('success' => $success, 'message' => $message));
        }
    }
}
