<!DOCTYPE html>
<html>
  <head>
    <title>Place details</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map-canvas {
        height: 400px;
        width: 400px;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
    
  </head>
  <body>
    <input type="text" id="mapsearch" size="50">
    <div id="map-canvas"></div>
    <form action="">
      <input type="hidden" name="lat" id="lat">
      <input type="hidden" name="lng" id="lng">
    </form>
    <script type="text/javascript">
      function initMap(){
        var map = new google.maps.Map(document.getElementById('map-canvas'),{
          center:{
            lat: 27.72,
            lng: 85.35
          },
          zoom: 15
        });

        var marker = new google.maps.Marker({
          position:{
            lat: 27.72,
            lng: 85.35
          },
          map: map,
          draggable: true
        });

        var searchBox = new google.maps.places.SearchBox(document.getElementById('mapsearch'));

        google.maps.event.addListener(searchBox, 'places_changed', function(){
          var places = searchBox.getPlaces();

          var bounds = new google.maps.LatLngBounds();
          var i, places;

          for(i = 0; place = places[i]; i++){
            console.log(place.geometry.location);

            bounds.extend(place.geometry.location);
            marker.setPosition(place.geometry.location);
          }

          map.fitBounds(bounds);
          map.setZoom(15);

        });


        google.maps.event.addListener(marker, 'dragend', function(){
          var lat = marker.getPosition().lat();
          var lng = marker.getPosition().lng();

          $('#lat').val(lat);
          $('#lng').val(lng);
        });
    }
    </script>

    <script src="js/jquery-3.1.1.min.js"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhBuIWDfjqk26jnvuR95_-ZHXhFV7dcdA&libraries=places&callback=initMap"></script>
    
  </body>
</html>