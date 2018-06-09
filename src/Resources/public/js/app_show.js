'use strict';

(function ($) {
    /** global: google */

    function initMap() {

        let storeLocation = $('#store-location');
        let latLng = {lat: storeLocation.data('lat'), lng: storeLocation.data('lng')};

        let map = new google.maps.Map(document.getElementById('map'), {
            zoom: 15,
            center: latLng
        });

        let marker = new google.maps.Marker({
            position: latLng,
            map: map
        });
    }

    initMap();
}(window.jQuery));