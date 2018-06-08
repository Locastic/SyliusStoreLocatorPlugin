'use strict';

(function ($) {

    var latitudeInput = $('#locastic_sylius_store_locator_plugin_store_latitude');
    var longitudeInput = $('#locastic_sylius_store_locator_plugin_store_longitude');
    var addressInput = document.getElementById('locastic_sylius_store_locator_plugin_store_address');
    var autocomplete = new google.maps.places.Autocomplete(addressInput);


    var mapsLoaded = window.google && window.google.maps;
    var map = {
        element: $('#mapHolder'),
        config: {
            mapTypeId: mapsLoaded && google.maps.MapTypeId.ROADMAP,
            zoom: 17,
            center: mapsLoaded && new google.maps.LatLng(latitudeInput.val(), longitudeInput.val())
        },
        markers: [],
        bounds: mapsLoaded && new google.maps.LatLngBounds(null)
    };

    autocomplete.addListener('place_changed', function () {
        var latlng = autocomplete.getPlace().geometry.location;

        latitudeInput.val(latlng.lat);
        longitudeInput.val(latlng.lng);

        map.setMarkers();
    });


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

        var markerConfig = {
            position: {
                lat: Number(latitudeInput.val()),
                lng: Number(longitudeInput.val())
            },
            map: map.instance
        };

        var marker = new google.maps.Marker(markerConfig);

        map.markers.push(marker);

        map.bounds.extend(new google.maps.LatLng({
            lat: markerConfig.position.lat,
            lng: markerConfig.position.lng
        }));
        map.instance.panTo(markerConfig.position);
    };


    map.setAddress = function () {
        var latlng = {
            lat: Number(latitudeInput.val()),
            lng: Number(longitudeInput.val())
        };

        var geocoder = new google.maps.Geocoder;

        geocoder.geocode({'location': latlng}, function (results, status) {
            if (status === 'OK') {
                if (results[0]) {
                    addressInput.value = results[0].formatted_address;
                }
            }
        });
    };

    map.instance = mapsLoaded && new google.maps.Map(map.element.get(0), map.config);

    google.maps.event.addListener(map.instance, 'click', function(event) {
        var latlng = event.latLng;

        latitudeInput.val(latlng.lat);
        longitudeInput.val(latlng.lng);

        map.setMarkers();
        map.setAddress();
    });


    map.setMarkers();

    latitudeInput.keyup(function () {
        map.setMarkers();
        map.setAddress();
    });

    longitudeInput.keyup(function () {
        map.setMarkers();
        map.setAddress();
    });

}(window.jQuery));