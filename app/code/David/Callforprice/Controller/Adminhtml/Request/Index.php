<?php
namespace David\Callforprice\Controller\Adminhtml\Request;
class Index extends \David\Callforprice\Controller\Adminhtml\Request
{
    public function execute()
    {
        $resultPage = $this->_resultPageFactory->create();
        return $resultPage;
    }
}
