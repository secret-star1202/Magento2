define([
    'jquery',
    'moment'
], function ($, moment) {
    'use strict';

    return function (validator) {
        validator.addRule(
            'vn-validate-phone',
            function (value) {
                // Tự động chuyển đổi giá trị phone number nếu bắt đầu bằng '84'
                if (value.indexOf('84') === 0) {
                    value = '0' + value.slice(2);
                }
                return /(0[3|5|7|8|9])+([0-9]{8})\b/.test(value);
            },
            $.mage.__('Incorrect VN number phone format.')
        );
        return validator;
    };
});
