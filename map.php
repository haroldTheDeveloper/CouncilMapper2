<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>CouncilMapper</title>
    <link rel="stylesheet" href="\style\stylesheets\main.css">
    <script src="\leaflet\leaflet.js"></script>
    <script src="\jquery\jquery-3.6.0.js"></script>
    <script src="\jquery-csv-main\src\jquery-csv.js"></script>
    <script src="\scripts\mapEvents.js"></script>
    <link href='/leaflet/leaflet.css' rel='stylesheet' />
    <script src="https://d3js.org/d3.v7.min.js"></script>
  </head>
  <!--<header>
    <?php include "./style/html/headerfile.html"?>
  </header>-->
  <body>
    <script src="./mapParse.JS"></script>
    <main>
        <section>
          <div id="map"></div>
          <script src="/scripts/mapEvents.js"></script>
          <script>
            var councilDirectory = "/assets/outputAreas/E06000024.json"
            let map = L.map("map", {center: [55.262218, -2.801472], zoom: 10});
            L.tileLayer(
                "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
                {attribution: "&copy; OpenStreetMap"}
            ).addTo(map);
            fetch(councilDirectory)
              .then(function(response) {
                  return response.json();
              })
              .then(function(data) {
                  L.geoJSON(data).on('click', function(e){
                      var District_Feature = e.sourceTarget.feature;
                      var District_ID = District_Feature.properties.OA11CD
                      console.log(District_ID)
                      fetch("/assets/Populations/Populations.json")
                        .then(function(response) {
                            return response.json();
                        })
                        .then(function(data) {
                          var populationID = population(data, District_ID)
                          console.log(populationID)
                        })
                  }).addTo(map);
              });

          </script>
        </section>
        <aside>
          <?php include "./style/html/aside.html"?>
        </aside>
      </main>
  </body>
</html>
