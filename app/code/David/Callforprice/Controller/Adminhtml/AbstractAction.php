<?php
namespace David\Callforprice\Controller\Adminhtml;
abstract class AbstractAction extends \Magento\Backend\App\Action
{
    const PARAM_CRUD_ID = 'id';

    protected $_jsHelper;

    protected $_storeManager;

    protected $_resultForwardFactory;

    
    protected $_resultLayoutFactory;

    
    protected $_resultPageFactory;

    
    protected $_requestFactory;

    
    protected $_requestCollectionFactory;

    
    protected $_coreRegistry;

    
    protected $_fileFactory;

  
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \David\Callforprice\Model\RequestFactory $requestFactory,
        \David\Callforprice\Model\ResourceModel\Request\CollectionFactory $requestCollectionFactory,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\App\Response\Http\FileFactory $fileFactory,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\View\Result\LayoutFactory $resultLayoutFactory,
        \Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Backend\Helper\Js $jsHelper
    ) {
        parent::__construct($context);
        $this->_coreRegistry = $coreRegistry;
        $this->_resultPageFactory = $resultPageFactory;
        $this->_resultLayoutFactory = $resultLayoutFactory;
        $this->_resultForwardFactory = $resultForwardFactory;
        $this->_fileFactory = $fileFactory;
        $this->_storeManager = $storeManager;
        $this->_jsHelper = $jsHelper;


        $this->_requestFactory = $requestFactory;
    
        $this->_requestCollectionFactory = $requestCollectionFactory;
     
    }

    
    protected function _getBackResultRedirect(\Magento\Framework\Controller\Result\Redirect $resultRedirect, $paramCrudId = null)
    {
        switch ($this->getRequest()->getParam('back')) {
            case 'edit':
                $resultRedirect->setPath(
                    '*/*/edit',
                    [
                        static::PARAM_CRUD_ID => $paramCrudId,
                        '_current' => true,
                    ]
                );
                break;
            case 'new':
                $resultRedirect->setPath('*/*/new', ['_current' => true]);
                break;
            default:
                $resultRedirect->setPath('*/*/');
        }

        return $resultRedirect;
    }
}
