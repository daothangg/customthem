<?php
namespace Adam\NewIn\Model\Layer;

class Resolver extends \Magento\Catalog\Model\Layer\Resolver
{
    public function __construct(
        \Magento\Framework\ObjectManagerInterface $objectManager,
        \Adam\NewIn\Model\Layer $layer,
        array $layersPool
    ) {
        $this->layer = $layer;
        parent::__construct($objectManager, $layersPool);
    }
    public function create($layerType)
    {
        
    }
}