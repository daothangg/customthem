define(
    [
        'uiComponent',
        'Magento_Checkout/js/model/quote'
    ],
    function (Component, quote) {
        'use strict';
        return Component.extend({
            defaults: {
                template: 'Magento_Checkout/custom-checkout-form'
            },
            initObservable: function () {
                this._super()
                    .observe('custom_field');
                return this;
            },
            /**
             * Send value to the quote
             */
            getCustomFieldValue: function () {
                return this.custom_field();
            },
            /**
             * Send value to the quote
             */
            setCustomFieldValue: function (value) {
                this.custom_field(value);
            },
        });
    }
);