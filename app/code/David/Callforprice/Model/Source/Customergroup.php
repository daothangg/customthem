<?php
namespace David\Callforprice\Model\Source;

class Customergroup implements \Magento\Framework\Option\ArrayInterface
{
    
    protected $request;

   
    public function __construct(\David\Callforprice\Model\Request $request)
    {
        $this->request = $request;
    }

    
    public function toOptionArray()
    {
		$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
		$customerGroups = $objectManager->get('\Magento\Customer\Model\ResourceModel\Group\Collection')->toOptionArray();
		return $customerGroups;
    }
}
