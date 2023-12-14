<?php
namespace Ced\FeaturedSlider\Block;
class Slider extends \Magento\Framework\View\Element\Template
{
	/**
     * @var \Magento\Catalog\Model\Resource\Product\CollectionFactory
     */
	 protected $_productCollectionFactory;
	 
	 /**
     * @var \Magento\Catalog\Model\Resource\Product\CollectionFactory
     */
	 protected $_imageHelper;
	 
     /**
     * @param \Magento\Catalog\Block\Product\Context $context
     * @param \Magento\Catalog\Model\Resource\Product\CollectionFactory $productCollectionFactory
     */
    public function __construct( \Magento\Catalog\Block\Product\Context $context,
								\Magento\Catalog\Model\Resource\Product\CollectionFactory $productCollectionFactory
	)
    {
        $this->_imageHelper = $context->getImageHelper();
        $this->_productCollectionFactory = $productCollectionFactory;

        
        parent::__construct($context);
	
    }
	/**
     * Retrieve featured products collection
     */
	public function getProducts()
	{
		$collection = $this->_productCollectionFactory->create();
		return $this->_productCollectionFactory->create()->addAttributeToSelect('*')->addAttributeToFilter('is_featured','1');
	}
	
}
