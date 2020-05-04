<!DOCTYPE html>
<html>
  <head>
    <title>WMS GetFeatureInfo (Layers)</title>
    <link rel="stylesheet" href="https://openlayers.org/en/v3.20.1/css/ol.css" type="text/css">
    <!-- The line below is only needed for old environments like Internet Explorer and Android 4.x -->
    <script src="https://cdn.polyfill.io/v2/polyfill.min.js?features=requestAnimationFrame,Element.prototype.classList,URL"></script>
    <script src="https://openlayers.org/en/v3.20.1/build/ol.js"></script>
  </head>
  <body>
    <table id="info">
      <tr>
        <td>All features:</td>
        <td id="all"></td>
      </tr>
      <tr>
        <td>Hotel features:</td>
        <td id="hotel"></td>
      </tr>
      <tr>
        <td>Restaurant features:</td>
        <td id="restaurant"></td>
      </tr>
    </table>
    <script>
      fetch('https://openlayers.org/en/v3.20.1/examples/data/wmsgetfeatureinfo/osm-restaurant-hotel.xml').then(function(response) {
        return response.text();
      }).then(function(response) {

        // this is the standard way to read the features
        var allFeatures = new ol.format.WMSGetFeatureInfo().readFeatures(response);
        document.getElementById('all').innerText = allFeatures.length.toString();

        // when specifying the 'layers' options, only the features of those
        // layers are returned by the format
        var hotelFeatures = new ol.format.WMSGetFeatureInfo({
          layers: ['hotel']
        }).readFeatures(response);
        document.getElementById('hotel').innerText = hotelFeatures.length.toString();

        var restaurantFeatures = new ol.format.WMSGetFeatureInfo({
          layers: ['restaurant']
        }).readFeatures(response);
        document.getElementById('restaurant').innerText = restaurantFeatures.length.toString();

      });
    </script>
  </body>
</html>
