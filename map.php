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
            var councilDirectory = []
            var NE = ["E06000001", "E06000002", "E06000003", "E06000004","E06000005", "E06000047", "E06000048", 'E08000020', 'E08000021', 'E08000022', 'E08000023', 'E08000024']
            var councils = ["E08000009"]
            var pop = calculateTotalPopulation(councils)
            console.log(pop)
            var newData
            for (let i = 0; i < councils.length; i++){
              var directory = '/assets/outputAreas/' + councils[i] + '.json'
              councilDirectory[i] = directory
            }
            let map = L.map("map", {center: [55.262218, -2.801472], zoom: 10});
            L.tileLayer(
                "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
                {attribution: "&copy; OpenStreetMap"}
            ).addTo(map);
            for (let i = 0; i < councilDirectory.length; i++){
              renderMap(map, councilDirectory[i], colours)
            }
            pop = calculateTotalPopulation(councils)
            console.log(pop)
          </script>
        </section>
      </main>
  </body>
</html>
