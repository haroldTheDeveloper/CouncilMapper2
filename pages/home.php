<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>CouncilMapper</title>
    <script src="\leaflet\leaflet.js"></script>
    <link rel="stylesheet" href="\style\stylesheets\main.css">
    <script src="https://d3js.org/d3.v7.min.js"></script>
  </head>
  <body>
    <header>
      <?php include "../style/html/headerfile.html"?>
    </header>
    <main class="pages">
      <section class="home_left">
        <div class="map-Boxes">
          <a href="\pages\council-list\districtList.php" class="map-Box">
            <p class="box-Title">
              Unitary and District Council
            </p>
          </a>
          <a href="\pages\council-list\countyList.php" class="map-Box">
            <p class="box-Title">
              County Council
            </p>
            <img >
          </a>
          <a href="\pages\council-list\nationList.php" class="map-Box">
            <p class="box-Title">
              House of Commons and Devolved
            </p>
          </a>
        </div>
      </section>
    </main>
  </body>
  <footer>
    <?php include "../style/html/footerfile.html"?>
  </footer>
</html>
