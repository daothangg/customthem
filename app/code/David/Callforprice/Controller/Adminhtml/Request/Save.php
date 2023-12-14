<?php
namespace David\Callforprice\Controller\Adminhtml\Request;

use Magento\Backend\App\Action;
use Magento\TestFramework\ErrorLog\Logger;

class Save extends \Magento\Backend\App\Action
{
  
    public function __construct(Action\Context $context)
    {
        parent::__construct($context);
    }

   
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('David_Callforprice::save');
    }

    public function execute()
    {   
        $writer = new \Zend_Log_Writer_Stream(BP . '/var/log/test.log');
        $logger = new \Zend_Log();
        $logger->addWriter($writer);
        $logger->info('text message');

        $data =  $this->getRequest()->getParam('request');
        $logger->info(print_r($data,true));
		$reply = @$data['reply'];
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            $model = $this->_objectManager->create('David\Callforprice\Model\Request');
			$id = $data['id'];
            if ($id) {
                $model->load($id);
            }
			$data['status'] = $reply ? 2 : $data['status'];
            $model->setData($data);

            $this->_eventManager->dispatch(
                'callforprice_request_prepare_save',
                ['requestModel' => $model, 'request' => $this->getRequest()]
            );

            try {
				$model->save();	
				$this->_objectManager->get('Magento\Backend\Model\Session')->setFormData(false);
				if($reply){
					/* call send mail method from helper or where you define it*/ 
					$receiverInfo  = $model->getCustomerEmail();
					$senderInfo = $this->_objectManager->get('David\Callforprice\Helper\Data')->getConfigValue('callforprice_settings/callforprice/email_from');
					$replyEmailTemplateId = $this->_objectManager->get('David\Callforprice\Helper\Data')->getConfigValue('callforprice_settings/callforprice/email_reply');
					
					$data = array();
					$data['name'] = $model->getCustomerName();
					$data['email'] = $receiverInfo;
					$data['telephone'] = $model->getCustomerTelephone();
					$data['detailproduct'] = $model->getProductName();
                    // $data['product_id']=$model->getProductId();
                    // $product = $objectManager->get('Magento\Catalog\Model\Product')->load($productId);
                    // $productId = $model['product_id'];
					$data['detailsreplied'] = $model->getReplyDetail();
					$this->_objectManager->get('David\Callforprice\Helper\Email')->sendMail($replyEmailTemplateId,$data,$senderInfo,$receiverInfo);
                    // $logger->info(print_r($model->getData(),true));
					
					
					$this->messageManager->addSuccess(__('You saved this request and send reply email'));
					return $resultRedirect->setPath('*/*/edit', ['id' => $model->getId(), '_current' => true]);
				}else{
					
					$this->messageManager->addSuccess(__('You saved this Request.'));
					if ($this->getRequest()->getParam('back')) {
						return $resultRedirect->setPath('*/*/edit', ['id' => $model->getId(), '_current' => true]);
					}
					return $resultRedirect->setPath('*/*/');
				}
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the request.'));
            }

            $this->_getSession()->setFormData($data);
            return $resultRedirect->setPath('*/*/edit', ['id' => $this->getRequest()->getParam('id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}
