<?php
namespace David\Callforprice\Model\ResourceModel\Request;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'id';

    /**
     * {@inheritdoc}
     */
    protected function _construct()
    {
        $this->_init('David\Callforprice\Model\Request', 'David\Callforprice\Model\ResourceModel\Request');
    }
}
