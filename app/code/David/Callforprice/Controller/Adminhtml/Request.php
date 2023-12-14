<?php
 
namespace David\Callforprice\Controller\Adminhtml;

abstract class Request extends \David\Callforprice\Controller\Adminhtml\AbstractAction
{
    const PARAM_CRUD_ID = 'id';

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('David_Callforprice::request');
    }
}