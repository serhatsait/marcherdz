var map = null;
var marker = null;
var infowindow = new google.maps.InfoWindow({
    size: new google.maps.Size(150, 50)
});

function createMarker(latlng, name, html) {

    var contentString = html;

    var marker = new google.maps.Marker({
        position: latlng,
        map: map,
        zIndex: Math.round(latlng.lat() * -100000) << 5
    });

    google.maps.event.addListener(marker, 'click', function () {
        infowindow.setContent(contentString);
        infowindow.open(map, marker);
    });

    google.maps.event.trigger(marker, 'click');
    return marker;

}

function initialize() {

    var myLatlng = new google.maps.LatLng(38.6803083, 34.2858385);

    var myOptions = {
        zoom: 6,
        center: myLatlng,
        mapTypeControl: true,
        mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
        navigationControl: true,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    }

    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

    marker = new google.maps.Marker({
        position: myLatlng,
        map: map,
    });

    formlat = document.getElementById("latbox").value = myLatlng.lat();
    formlng = document.getElementById("lngbox").value = myLatlng.lng();

    // close popup window
    google.maps.event.addListener(map, 'click', function () {
        infowindow.close();
    });
    google.maps.event.addListener(map, 'zoom_changed', function () {
        var z = map.getZoom();
        document.getElementById("zoom").value = z;
    });

    google.maps.event.addListener(map, 'click', function (event) {
        //call function to create marker
        if (marker) {
            marker.setMap(null);
            marker = null;
        }

        var myLatLng = event.latLng;

        marker = new google.maps.Marker({
            position: myLatLng,
            map: map,
        });

        formlat = document.getElementById("latbox").value = event.latLng.lat();
        formlng = document.getElementById("lngbox").value = event.latLng.lng();
    });


}
function codeAddress() {
    var address = document.getElementById("address").value;
    geocoder = new google.maps.Geocoder();
    geocoder.geocode({
        'address': address
    }, function (results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            var myOptions = {
                zoom: 15,
                center: results[0].geometry.location,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            }
            map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
            google.maps.event.addListener(map, 'zoom_changed', function () {
                var z = map.getZoom();
                document.getElementById("zoom").value = z;
            });

            var marker = new google.maps.Marker({
                map: map,
                position: results[0].geometry.location
            });
            google.maps.event.addListener(map, 'click', function (event) {
                if (marker) {
                    marker.setMap(null);
                    marker = null;
                }
                var myLatLng = event.latLng;
                marker = new google.maps.Marker({
                    position: myLatLng,
                    map: map,
                    zoom: 15

                });
                formlat = document.getElementById("latbox").value = event.latLng.lat();
                formlng = document.getElementById("lngbox").value = event.latLng.lng();

            });


        }
    });
}