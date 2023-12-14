<?php
namespace David\Callforprice\Controller;

abstract class Request extends \Magento\Backend\App\Action
{
    
    protected $_requestFactory;

  
    protected $_coreRegistry;


    
    public function __construct(
        \David\Callforprice\Model\RequestFactory $requestFactory,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Backend\App\Action\Context $context
    )
    {
        $this->_requestFactory        = $requestFactory;
        $this->_coreRegistry          = $coreRegistry;
        parent::__construct($context);
    }


    protected function _initRequest()
    {
        $writer = new \Zend_Log_Writer_Stream(BP . '/var/log/custom.log');
        $logger = new \Zend_Log();
        $logger->addWriter($writer);
        $logger->info('text message');

        $requestId  = (int) $this->getRequest()->getParam('id');
   
        $request    = $this->_requestFactory->create();
        if ($requestId) {
            $request->load($requestId);
        }
        $this->_coreRegistry->register('david_callforprice_request', $request);
        $logger->info(print_r($request->getData(),true));
        return $request;
    }

}
