<?php
namespace David\Callforprice\Controller\Adminhtml\Request;

use Magento\Backend\App\Action\Context;
use Magento\Ui\Component\MassAction\Filter;
use David\Callforprice\Model\ResourceModel\Request\CollectionFactory;
use Magento\Framework\Controller\ResultFactory;

class MassNew extends \Magento\Backend\App\Action
{
	protected $_filter;
    /**
     * @var CollectionFactory
     */
    protected $_collectionFactory;


    /**
     * @param Context $context
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(Context $context, Filter $filter, CollectionFactory $collectionFactory)
    {
        $this->_filter = $filter;
        $this->_collectionFactory = $collectionFactory;
        parent::__construct($context);
    }
   
    public function execute()
    {
        $collection = $this->_filter->getCollection($this->_collectionFactory->create());
		$collectionSize = $collection->getSize();
		
        foreach ($collection as $item) {
            $item->setSatus(1);
            $item->save();
        }

        $this->messageManager->addSuccess(__('A total of %1 record(s) have been set to New', $collectionSize));

        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('*/*/');
    }
}
