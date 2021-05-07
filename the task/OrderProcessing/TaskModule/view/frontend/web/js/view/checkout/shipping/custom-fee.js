define([
        'ko',
        'uiComponent',
        'Magento_Checkout/js/model/quote',
        'Magento_Catalog/js/price-utils'

    ], function (ko, Component, quote, priceUtils) {
        'use strict';
        var show_hide_TaskModule_blockConfig = window.checkoutConfig.show_hide_TaskModule_shipblock;
        var fee_label = window.checkoutConfig.fee_label;         
        var custom_fee_amount = window.checkoutConfig.custom_fee_amount;
        
        return Component.extend({
            defaults: {
                template: 'OrderProcessing_TaskModule/checkout/shipping/custom-fee'
            },
            canVisibleTaskModuleBlock: show_hide_TaskModule_blockConfig,
            getFormattedPrice: ko.observable(priceUtils.formatPrice(custom_fee_amount, quote.getPriceFormat())),
            getFeeLabel:ko.observable(fee_label)
        });
    });
