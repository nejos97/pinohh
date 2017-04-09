<?php
if (isset($_GET['lat']) AND isset($_GET['long']))
{
  echo "";
  $lat = $_GET['lat'];
  $long = $_GET['long'];;
?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Traffic layer</title>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height : 70%;
        padding:20px;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;

      }
    </style>
  </head>
  <body>
    <h1><center>TRAFFIC LAYER OFFER BY PINOHH</center></h1>
    <div id="map"></div>
    <script>
      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 15,
          center: {lat: <?php echo $lat ?>, lng: <?php echo $long ?> }
        });

        var trafficLayer = new google.maps.TrafficLayer();
        trafficLayer.setMap(map);
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key= AIzaSyCi2F2XVDZroa-FheMhrhK3KiV1FO_bZGA &callback=initMap">
    </script>
  </body>
</html>
<?php
}
?>
