<style>
    #googleMap{
        height: 400px
    }
    #description {
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
    }

    #infowindow-content .title {
        font-weight: bold;
    }

    #infowindow-content {
        display: none;
    }

    #map #infowindow-content {
        display: inline;
    }

    .pac-card {
        margin: 10px 10px 0 0;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        background-color: #fff;
        font-family: Roboto;
    }

    #pac-container {
        padding-bottom: 12px;
        margin-right: 12px;
    }

    .pac-controls {
        display: inline-block;
        padding: 5px 11px;
    }

    .pac-controls label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
    }

    #pac-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 45%;
        height: 40px;
        margin-top: 10px;
        /*max-width: 80%;*/
    }

    #pac-input:focus {
        border-color: #4d90fe;
    }

    #title {
        color: #fff;
        background-color: #4d90fe;
        font-size: 25px;
        font-weight: 500;
        padding: 6px 12px;
    }
    #target {
        width: 345px;
    }
</style>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA9UeezZ2xyNjrwck8SLdh9NxsJp6HhLQc&libraries=places"></script>
<script>
    /*
     Latitude: 23.96617587126503
     Longitude: 45.3955078125
     */


    var map;
    var myCenter = new google.maps.LatLng(<?= (empty($value)) ? "23.96617587126503,45.3955078125" : $value ?>);

    var infoWindows = [];
    var markers = [];

    function placeMarker(location) {


        var marker = new google.maps.Marker({
            position: location,
            map: map,
        });

//        document.getElementById("latitude").value = location.lat();
//        document.getElementById("longitude").value = location.lng();

        document.getElementById("map_set_value").value = location.lat() + "," + location.lng();

        var latlng = new google.maps.LatLng(location.lat(), location.lng());
        var geocoder = geocoder = new google.maps.Geocoder();
        geocoder.geocode({'latLng': latlng}, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                if (results[1]) {
                    $(".map_address").val(results[1].formatted_address);
                }
            }
        });

        var infowindow = new google.maps.InfoWindow({
            content: 'Latitude: ' + location.lat() + '<br>Longitude: ' + location.lng()
        });

        infowindow.open(map, marker);

        infoWindows.push(infowindow);
        markers.push(marker);


    }

    function closeAllInfoWindows() {
        for (var i = 0; i < infoWindows.length; i++) {
            infoWindows[i].close();
        }
    }


    function setAllMap(map) {

        for (var i = 0; i < markers.length; i++) {
            markers[i].setMap(map);
        }
    }

    function clearMarkers() {
        setAllMap(null);
    }


    function initialize()
    {

        var mapProp = {
            center: myCenter,
            zoom: 13,
            mapTypeId: 'roadmap'
//            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        map = new google.maps.Map(document.getElementById("googleMap"), mapProp);

// Create the search box and link it to the UI element.
        var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function () {
            searchBox.setBounds(map.getBounds());
        });

        var infoWindow = new google.maps.InfoWindow({map: map});

// Try HTML5 geolocation.
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };

//                document.getElementById("latitude").value = position.coords.latitude;
//                document.getElementById("longitude").value = position.coords.longitude;

<?php if (empty($value)): ?>
                    infoWindow.setPosition(pos);
                    infoWindow.setContent('موقعك الحالي');
                    var latlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                    var geocoder = geocoder = new google.maps.Geocoder();
                    geocoder.geocode({'latLng': latlng}, function (results, status) {
                        if (status == google.maps.GeocoderStatus.OK) {
                            if (results[1]) {
                                $(".map_address").val(results[1].formatted_address);
                            }
                        }
                    });
                    document.getElementById("map_set_value").value = position.coords.latitude + "," + position.coords.longitude;
                    //   map.setCenter(pos);
<?php endif; ?>
            }, function () {
                handleLocationError(true, infoWindow, map.getCenter());
            });
        } else {
            // Browser doesn't support Geolocation
            handleLocationError(false, infoWindow, map.getCenter());
        }

        function handleLocationError(browserHasGeolocation, infoWindow, pos) {
            infoWindow.setPosition(pos);
            infoWindow.setContent(browserHasGeolocation ?
                    'Error: The Geolocation service failed.' :
                    'Error: Your browser doesn\'t support geolocation.');
        }

        searchBox.addListener('places_changed', function () {
            var places = searchBox.getPlaces();

            if (places.length == 0) {
                return;
            }

            // Clear out the old markers.
            markers.forEach(function (marker) {
                marker.setMap(null);
            });
            markers = [];

            // For each place, get the icon, name and location.
            var bounds = new google.maps.LatLngBounds();
            places.forEach(function (place) {
                if (!place.geometry) {
                    console.log("Returned place contains no geometry");
                    return;
                }
                var icon = {
                    url: place.icon,
                    size: new google.maps.Size(71, 71),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(17, 34),
                    scaledSize: new google.maps.Size(25, 25)
                };

//                document.getElementById("latitude").value = place.geometry.location.lat();
//                document.getElementById("longitude").value = place.geometry.location.lng();

                document.getElementById("map_set_value").value = place.geometry.location.lat() + "," + place.geometry.location.lng();

                var latlng = new google.maps.LatLng(place.geometry.location.lat(), place.geometry.location.lng());
                var geocoder = geocoder = new google.maps.Geocoder();
                geocoder.geocode({'latLng': latlng}, function (results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        if (results[1]) {
                            $(".map_address").val(results[1].formatted_address);
                        }
                    }
                });


                // Create a marker for each place.
                markers.push(new google.maps.Marker({
                    map: map,
//                    icon: icon,
                    title: place.name,
                    position: place.geometry.location
                }));

                if (place.geometry.viewport) {
                    // Only geocodes have viewport.
                    bounds.union(place.geometry.viewport);
                } else {
                    bounds.extend(place.geometry.location);
                }
            });
            map.fitBounds(bounds);
        });


        var marker = new google.maps.Marker({
            position: myCenter,
            map: map,
            title: 'Hello World!'
        });



        var infowindow = new google.maps.InfoWindow({
            content: 'Latitude: ' + myCenter.lat() + '<br>Longitude: ' + myCenter.lng()
        });
        infowindow.open(map, marker);




        google.maps.event.addListener(map, 'click', function (event) {
            infowindow.close();
            closeAllInfoWindows();
            clearMarkers();
            placeMarker(event.latLng);

        });

    }



    google.maps.event.addDomListener(window, 'load', initialize);


</script>



<div class="col-md-12">
    <?php if ($title != null): ?>
        <label class="col-form-label" for="input_{{$name}}">
            <?= $title ?>
        </label>
    <?php endif; ?>
    <input id="pac-input" class="controls form-control border" type="text" placeholder="بحث بالعنوان">
    <div class="mb-3  w-100 rounded border <?= $class ?>" <?= $data ?> id="googleMap"  style="width:100%;height:500px;" dir="ltr" ></div>
    <?php if ($error): ?>
                <div class="text-danger"><?= $error ?></div>
    <?php endif; ?>
    <input type="hidden" value="<?= $value ?>" name="<?= $name ?>" id="map_set_value" />
    <input type="hidden" name="map_address" class="map_address" value="">
</div>
