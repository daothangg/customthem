<?php

namespace Magento_Checkout\Model\Plugin\Checkout;

class LayoutProcessorPlugin
{
    public function afterProcess(
        \Magento\Checkout\Block\Checkout\LayoutProcessor $subject,
        array $jsLayout
    )
    {
        $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']
        ['shippingAddress']['children']['shipping-address-fieldset']['children']['street'] = [
            'component' => 'Magento_Ui/js/form/components/group',
            'label' => __('Address Label'), //sreet address main label
            'required' => false, // set false if removed sreet address label
            'dataScope' => 'shippingAddress.street',
            'provider' => 'checkoutProvider',
            'sortOrder' => 0,
            'type' => 'group',
            'additionalClasses' => 'street',
            'children' => [   // here add children as per your requirement
                [
                    'label' => __('Address Label 1'),
                    'component' => 'Magento_Ui/js/form/element/abstract',
                    'config' => [
                        'customScope' => 'shippingAddress',
                        'template' => 'ui/form/field',
                        'elementTmpl' => 'ui/form/element/input'
                    ],
                    'dataScope' => '0',
                    'provider' => 'checkoutProvider',
                    'validation' => ['required-entry' => true, "min_text_len‌​gth" => 1, "max_text_length" => 255],
                ],
                [
                    'label' => __('Address Label 2'),
                    'component' => 'Magento_Ui/js/form/element/abstract',
                    'config' => [
                        'customScope' => 'shippingAddress',
                        'template' => 'ui/form/field',
                        'elementTmpl' => 'ui/form/element/input'
                    ],
                    'dataScope' => '1',
                    'provider' => 'checkoutProvider',
                    'validation' => ['required-entry' => true, "min_text_len‌​gth" => 1, "max_text_length" => 255],
                ],
                [
                    'label' => __('Address Label 3'),
                    'component' => 'Magento_Ui/js/form/element/abstract',
                    'config' => [
                        'customScope' => 'shippingAddress',
                        'template' => 'ui/form/field',
                        'elementTmpl' => 'ui/form/element/input'
                    ],
                    'dataScope' => '2',
                    'provider' => 'checkoutProvider',
                    'validation' => ['required-entry' => true, "min_text_len‌​gth" => 1, "max_text_length" => 255],
                ],
            ]
        ];
        return $jsLayout;
    }
}