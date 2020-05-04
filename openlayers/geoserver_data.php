<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Open Layers GeoServer</title>
    <link rel="stylesheet" href="css/ol.css">
    <script src="js/ol.js" type="text/javascript" charset="utf-8"></script>
  </head>
  <body>
    <div id="info">&nbsp;</div>
    <div id="map">

    </div>
    <script type="text/javascript">
    var map = new ol.Map({
      view: new ol.View({
        center: [-9000000, -190000],
        zoom: 7
      }),
      layers: [
        new ol.layer.Tile({
          source: new ol.source.OSM()
        })
      ],
      target: 'map'
    });

    var provincia = new ol.layer.Image({
      source: new ol.source.ImageWMS({
        url:'http://localhost:8080/geoserver/aguapotable.apptics.com.ec/wms',
        params:{'LAYERS':'aguapotable.apptics.com.ec:limite_celir_provincial'},
        serverType:'geoserver'
      })
    });

    provincia.setOpacity(0.3);
    map.addLayer(provincia);

    
    </script>

  </body>
</html>
