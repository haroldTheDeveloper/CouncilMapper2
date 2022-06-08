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
  <header>
    <?php include "./style/html/headerfile.html"?>
  </header>
  <body>
    <script src="./mapParse.JS"></script>
    <main>
        <section>
          <div id="map"></div>
          <script src="/scripts/mapEvents.js"></script>
          <script>
            var councilDirectory = "/assets/outputAreas/E06000001.json"
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
                      var layer = e.sourceTarget;
                      console.log(layer)
                      var District_ID = District_Feature.properties.OA11CD
                      console.log(District_ID)
                      fetch("/assets/Populations/Populations.json")
                        .then(function(response) {
                            return response.json();
                        })
                        .then(function(data) {
                          var countOnClick = null
                          var Constituency_ID = 1
                          if (countOnClick == null){
                            var newData = data
                            newData = assign(District_ID, Constituency_ID, newData)
                          }
                          if (countOnClick == null){
                            countOnClick = 1
                          }
                          if (populations2 == null){
                            var colours = ['red', 'blue']
                            var populations2 = [0,0]
                            for (let i = 0; i <= colours; i++){
                              populations2[i] == 0
                            }
                          }
                          newData = assign(District_ID, Constituency_ID, newData)
                          var populationID = populationDis(newData, District_ID)
                          colourSeat(layer, Constituency_ID, colours)
                          var populations2 = populationCalc(Constituency_ID, newData, populations2)
                        })
                      }).on('contextmenu', function(ev) {
                        return false;
                        Constituency_ID = 0
                        fetch("/assets/Populations/Populations.json")
                          .then(function(response) {
                              return response.json();
                          })
                          .then(function(data){
                            var data = assign(District_ID, Constituency_ID, data)
                            colourSeat(layer, Constituency_ID, colours)
                            var populations2 = populationCalc(Constituency_ID, data, populations2)
                          })
                      }, false)
                  .addTo(map);
              });

          </script>
        </section>
        <aside>
          <?php include "./style/html/aside.html"?>
        </aside>
      </main>
  </body>
</html>
