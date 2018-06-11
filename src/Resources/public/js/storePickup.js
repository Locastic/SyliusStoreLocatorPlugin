'use strict';

(function ($) {
    let itemSelector = $('.item');
    let locationPickupCheckboxSelector = $('div.pick-up div.checkbox');
    let storeDropdownSelector = $('.store-select');

    storeDropdownSelector.hide();

    itemSelector.on('click', function (event) {
        if (locationPickupCheckboxSelector.hasClass('checked')) {
            storeDropdownSelector.show();
        } else {
            storeDropdownSelector.hide();
        }
    });

}(window.jQuery));