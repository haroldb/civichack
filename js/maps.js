//AIzaSyA7Tq9Y5gDSBuFMBjdt3fhjozyLjdHb3v0

if (siteRequest[3] == 'view-ratings ') {

    function initialize() {
      var mapOptions = {
        zoom: 8,
        center: new google.maps.LatLng(52.6360771, -1.1311002)
      };

      var map = new google.maps.Map(document.getElementById('map-canvas'),
          mapOptions);
    }

    function loadScript() {
      var script = document.createElement('script');
      script.type = 'text/javascript';
      script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&' +
          'callback=initialize';
      document.body.appendChild(script);

      loadMarkers();
    }

    function loadMarkers() {
        var latLngHolder = [];
        var latLng;
        $( ".postcodeval" ).each(function( index ) {
            var classHold = 'postcode' + index;
            if (RateMyLandlord.isValidPostcode($("." + classHold).html())) {
                latLng = RateMyLandlord.postcodeToLatLng($("." + classHold).html());
                latLngHolder.push({'lat' : latLng.lat, 'lng' : latLng.lng});
            }
        });

        $( latLngHolder ).each(function( index ) {
           var myLatlng = new google.maps.LatLng(latLngHolder[index].lat,latLngHolder[index].lng);
           console.log(myLatlng);
        });
    }


}



window.onload = loadScript;