'use strict';

(function ($) {
    let itemSelector = $('.item');
    let locationPickupCheckboxSelector = $('div.pick-up div.checkbox :input[value="pickup_at_store"]');
    let storeDropdownSelector = $('.store-select');

    var handleShopDropdown = function () {
        if (locationPickupCheckboxSelector.prop( "checked" )) {
            storeDropdownSelector.show();
        } else {
            storeDropdownSelector.hide();
        }
    };

    handleShopDropdown();

    itemSelector.on('click', function (event) {
        handleShopDropdown();
    });



}(window.jQuery));