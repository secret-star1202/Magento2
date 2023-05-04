define([
    'jquery',
    'moment'
], function ($, moment) {
    'use strict';

    return function (validator) {
        validator.addRule(
            'vn-validate-phone',
            function (value) {
                return /(84|0[3|5|7|8|9])+([0-9]{8})\b/.test(value);
            },
            $.mage.__('Incorrect VN number phone format.')
        );
        return validator;
    };
});
