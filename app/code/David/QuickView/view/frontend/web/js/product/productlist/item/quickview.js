
define([
    'jquery',
    'Magento_Ui/js/modal/modal',
    'mage/loader',
    'Magento_Customer/js/customer-data'
    ], function ($, modal, loader, customerData) {
    'use strict';
    return function (config, node) {
        var product_id = jQuery(node).data('id');
        var product_url = jQuery(node).data('url');
        var options = {
            type: 'popup',
            responsive: true,
            innerScroll: false,
            title: $.mage.__('Quick View Title'),
            buttons: [{
                text: $.mage.__('Close'), class: 'close-modal', click: function () {
                    this.closeModal();
                }
            }]
        };
        var popup = modal(options, $('#quick_view_container' + product_id));
        $("#quick_view_button" + product_id).on("click", function () {
            openquickviewpopup();
        });
        var openquickviewpopup = function () {
            var modalContainer = $("#quick_view_container" + product_id);
            modalContainer.html(create_iframe_data());
            var iframearea = "#frame_product" + product_id;
            $(iframearea).on("load", function () {
                modalContainer.addClass("product-quickview");
                modalContainer.modal('openModal');
                observeAddToCart(this);
            });
        };
        var observeAddToCart = function (iframe) {
            var doc = iframe.contentWindow.document;
            $(doc).contents().find('#product_addtocart_form').submit(function (e) {
                e.preventDefault();
                $.ajax({
                    data: $(this).serialize(),
                    type: $(this).attr('method'),
                    url: $(this).attr('action'),
                    success: function (response) {
                        $(".close-modal").trigger("click");
                        $('[data-block="minicart"]').find('[data-role="dropdownDialog"]').dropdownDialog("open");
                    }
                });
            });
        };
        var create_iframe_data = function () {
            return $('<iframe />', {id: 'frame_product' + product_id, src: product_url + "?iframe=1"});
        }
    };
});