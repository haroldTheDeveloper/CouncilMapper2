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
      <?php
      $path = $_SERVER['DOCUMENT_ROOT'];
      $path .= "\style\html\headerfile.html";
      include $path?>
    </header>
    <main>
    </main>
    <footer>
      <?php
      $path = $_SERVER['DOCUMENT_ROOT'];
      $path .= "\style\html\footerfile.html"; 
      include $path?>
    </footer>
  </body>
</html>
