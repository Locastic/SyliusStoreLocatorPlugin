'use strict';

(function ($) {

    var latitudeInput = $('#locastic_sylius_store_locator_plugin_store_latitude');
    var longitudeInput = $('#locastic_sylius_store_locator_plugin_store_longitude');

    var mapsLoaded = window.google && window.google.maps;
    var map = {
        element: $('#mapHolder'),
        config: {
            mapTypeId: mapsLoaded && google.maps.MapTypeId.ROADMAP,
            zoom: 16,
            center: mapsLoaded && new google.maps.LatLng(latitudeInput.val(), longitudeInput.val())
        },
        markers: [],
        bounds: mapsLoaded && new google.maps.LatLngBounds(null)
    };


    map.getMarkerById = function (id) {
        var i = 0;
        for (; i < map.markers.length; i++) {
            if (map.markers[i].locationId == id) {
                console.log(map.markers[i]);
                return map.markers[i];
            }
        }
        return null;
    };

    map.clear = function () {
        if (!map.instance) {
            return;
        }
        $.each(map.markers, function () {
            this.setMap(null);
        });
        map.markers = [];
        map.bounds = new google.maps.LatLngBounds(null);
    };

    map.setMarkers = function () {
        map.clear();

        if (!map.instance) {
            return;
        }

        console.log(latitudeInput.val());
        console.log(longitudeInput.val());

        var markerConfig = {
            position: {
                lat: Number(latitudeInput.val()),
                lng: Number(longitudeInput.val())
            },
            map: map.instance,
            animation: google.maps.Animation.DROP
        };

        var marker = new google.maps.Marker(markerConfig);

        map.markers.push(marker);

        map.bounds.extend(new google.maps.LatLng({
            lat: markerConfig.position.lat,
            lng: markerConfig.position.lng
        }));
        map.instance.panToBounds(map.bounds);
        map.instance.fitBounds(map.bounds);
    };

    map.instance = mapsLoaded && new google.maps.Map(map.element.get(0), map.config);

    map.setMarkers();

    latitudeInput.change(function () {
        map.setMarkers();
    });

    longitudeInput.change(function () {
        map.setMarkers();
    });

}(window.jQuery));