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
    <main id='districtList'>
      <script>
          var colours = ["red", "green", "orange", "blue", "purple"]
          var numCouncils = 900
          for (let i = 0; i < numCouncils; i++){
            var number = String(i);
            var boundaryId = "council" + number;
            const boundaryInfoBox = document.createElement("button");
            boundaryInfoBox.setAttribute('id',boundaryId)
            const textAdd = document.createTextNode(number);
            const textAddPop = document.createTextNode(populations2[i]);
            boundaryInfoBox.appendChild(textAdd);
            const element = document.getElementById("districtList");
            element.appendChild(boundaryInfoBox);
            document.getElementById(boundaryId).style.backgroundColor = 'white'
            document.getElementById(boundaryId).style.color = 'white'
            document.getElementById(boundaryId).style.margin = '0.5vh'
            document.getElementById(boundaryId).style.padding = '0.5vh'
            document.getElementById(boundaryId).style.borderRadius = '1vw'
            document.getElementById(boundaryId).style.width = '20vw'
            document.getElementById(boundaryId).style.height = '20vw'
            document.getElementById(boundaryId).style.opacity = 0.2
            document.getElementById(boundaryId).style.borderColor = 'white'
            document.getElementById(boundaryId).addEventListener('mouseover', function(){
              this.style.opacity = 0.9
            })
          };
      </script>
    </main>
  </body>
</html>
