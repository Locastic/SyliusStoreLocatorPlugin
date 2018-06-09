'use strict';

(function ($) {
    /** global: google */

    function initMap() {
        let map = new google.maps.Map(document.getElementById('map'));
        map.bounds = new google.maps.LatLngBounds();

        let stores = $('.store-location');

        stores.each(function () {
            let latLng = {lat: $(this).data('lat'), lng: $(this).data('lng')};
            let marker = new google.maps.Marker({
                position: latLng,
                map: map,
                title: 'Hello World!'
            });

            map.bounds.extend(latLng);
        });

        map.fitBounds(map.bounds);
    }

    initMap();
}(window.jQuery));