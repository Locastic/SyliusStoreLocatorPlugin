'use strict';

(function ($) {
    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'));
        map.bounds = new google.maps.LatLngBounds();

        var stores = $('.store-location');

        stores.each(function (index) {
            var latLng = {lat: $(this).data('lat'), lng: $(this).data('lng')};
            var marker = new google.maps.Marker({
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