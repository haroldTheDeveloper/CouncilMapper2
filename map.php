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
    <main>
      <aside>
        <?php include "./style/html/aside.html"?>
      </aside>
        <section>
          <div id="map"></div>
          <script src="/scripts/mapEvents.js"></script>
          <script>
            var councilDirectory = ["/assets/outputAreas/E06000001.json", "/assets/outputAreas/E06000002.json", "/assets/outputAreas/E06000003.json", "/assets/outputAreas/E06000004.json"]
            var councils = ["E06000001", "E06000002", "E06000003", "E06000004"]
            let map = L.map("map", {center: [55.262218, -2.801472], zoom: 10});
            L.tileLayer(
                "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
                {attribution: "&copy; OpenStreetMap"}
            ).addTo(map);
            for (let i = 0; i < councilDirectory.length; i++){
              renderMap(map, councilDirectory[i], Constituency_ID, colours)
            }

            var pop = calculateTotalPopulation(councils)
            console.log(pop)
          </script>
        </section>
      </main>
  </body>
</html>
