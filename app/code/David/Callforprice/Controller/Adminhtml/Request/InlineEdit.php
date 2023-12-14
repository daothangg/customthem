<?php

namespace David\Callforprice\Controller\Adminhtml\Request;

class InlineEdit extends \Magento\Backend\App\Action
{
  
    protected $_jsonFactory;

   
    protected $_requestFactory;

    
    public function __construct(
        \Magento\Framework\Controller\Result\JsonFactory $jsonFactory,
        \David\Callforprice\Model\RequestFactory $requestFactory,
        \Magento\Backend\App\Action\Context $context
    )
    {
        $this->_jsonFactory = $jsonFactory;
        $this->_requestFactory = $requestFactory;
        parent::__construct($context);
    }

    
    public function execute()
    {
        $resultJson = $this->_jsonFactory->create();
        $error = false;
        $messages = [];
        $postItems = $this->getRequest()->getParam('items', []);
        if (!($this->getRequest()->getParam('isAjax') && count($postItems))) {
            return $resultJson->setData([
                'messages' => [__('Please correct the data sent.')],
                'error' => true,
            ]);
        }
        foreach (array_keys($postItems) as $requestId) {
            
            $request = $this->_requestFactory->create()->load($requestId);
            try {
                $requestData = $postItems[$requestId];//todo: handle dates
                $request->addData($requestData);
                $request->save();
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $messages[] = $this->getErrorWithRequestId($request, $e->getMessage());
                $error = true;
            } catch (\RuntimeException $e) {
                $messages[] = $this->getErrorWithRequestId($request, $e->getMessage());
                $error = true;
            } catch (\Exception $e) {
                $messages[] = $this->getErrorWithRequestId(
                    $request,
                    __('Something went wrong while saving the Request.')
                );
                $error = true;
            }
        }
        return $resultJson->setData([
            'messages' => $messages,
            'error' => $error
        ]);
    }


    protected function getErrorWithRequestId(\David\Callforprice\Model\Request $request, $errorText)
    {
        return '[Request ID: ' . $request->getId() . '] ' . $errorText;
    }
}
