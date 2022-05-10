<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>CouncilMapper</title>
    <link rel="stylesheet" href="\style\stylesheets\main.css">
    <script src='https://api.mapbox.com/mapbox.js/v3.3.1/mapbox.js'></script>
    <link href='https://api.mapbox.com/mapbox.js/v3.3.1/mapbox.css' rel='stylesheet' />
    <script src="https://d3js.org/d3.v7.min.js"></script>
  </head>
  <body>
    <header>
      <?php include "./style/html/headerfile.html"?>
    </header>
    <script src="./mapParse.JS"></script>
    <main>
        <aside>
          <?php include "./style/html/aside.html"?>
        </aside>
      </main>
      <section>
        <div id="map"></div>
        <script>
          L.mapbox.accessToken = 'pk.eyJ1IjoidGhhdGVuZ2xpc2htYXBwZXIiLCJhIjoiY2wyeDlkeXFjMHRpbTNibXB5aWZudmU2eCJ9.XnfkB0MsXiSktmzl42CVOA';
          var map = L.mapbox.map('map')
              .setView([52.5, 0], 7)
              .addLayer(L.mapbox.styleLayer('mapbox://styles/mapbox/streets-v11'));
          map.addLayer("./assets/outputAreas/Output_Areas__December_2011__Boundaries_EW_BFC.geojson")
        </script>
        <script src="./scripts/mapRender.js"></script>
        <script src="./scripts/councilPuller.js"></script>
      </section>
    <footer>
    </footer>
  </body>
</html>
