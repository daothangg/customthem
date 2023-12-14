<?php
namespace David\Callforprice\Model\Source;

class Status implements \Magento\Framework\Data\OptionSourceInterface
{
   
    protected $request;

  
    public function __construct(\David\Callforprice\Model\Request $request)
    {
        $this->request = $request;
    }

  
    public function toOptionArray()
    {
        $options[] = ['label' => '', 'value' => ''];
        $availableOptions = $this->request->getAvailableStatuses();
        foreach ($availableOptions as $key => $value) {
            $options[] = [
                'label' => $value,
                'value' => $key,
            ];
        }
        return $options;
    }
}
