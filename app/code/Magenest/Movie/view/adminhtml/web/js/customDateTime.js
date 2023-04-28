/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

define([
    'Magento_Ui/js/form/element/date'
], function (Element) {
    'use strict';

    return Element.extend({
        defaults: {
            minDate: '10'
        },
    });
});
