<?php

namespace David\CustomOrderNumber\Plugin\Model\Quote\ResourceModel;

use Magento\Quote\Model\ResourceModel\Quote;

class QuotePlugin
{
    /**
     * @var \David\CustomOrderNumber\Helper\Generator
     */
    protected $incrementIdGenerator;

    /**
     * QuotePlugin constructor.
     *
     * @param \David\CustomOrderNumber\Helper\Generator $incrementIdGenerator
     */
    public function __construct(
        \David\CustomOrderNumber\Helper\Generator $incrementIdGenerator
    ) {
        $this->incrementIdGenerator = $incrementIdGenerator;
    }

    /**
     * @param Quote $subject
     * @param \Closure $proceed
     * @param \Magento\Quote\Model\Quote $quote
     * @return mixed
     */
    public function aroundGetReservedOrderId(Quote $subject, \Closure $proceed, $quote)
    {
        $originalSequence = $proceed($quote);
        // Generate new increment ID
        $incrementId = $this->incrementIdGenerator->generateIncrementId($quote, \Magento\Sales\Model\Order::ENTITY, $originalSequence);
        return $incrementId;
    }
}
