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
          var councilNames = []
          var numCouncils = 0
          const districtListing = async function(councilNames, numCouncils){
              var response = await fetch('/assets/outputAreas/CouncilCodes.json')
              var data = await response.json()
              var response = await fetch('/assets/outputAreas/CouncilCodes.json')
              var data2 = await response.json()
              numCouncils = data.length
              console.log(numCouncils)
              for (let i = 0; i < data.length; i++){
                councilNames[i] = data[i].LAD16NM
              }
            for (let i = 0; i < numCouncils; i++){
              var number = String(i);
              var boundaryId = "council" + data[i].LAD16CD;
              var inputId = boundaryId + 'a'
              const boundaryInfoBox = document.createElement("button");
              boundaryInfoBox.setAttribute('id',boundaryId)
              const textAdd = document.createTextNode(councilNames[i]);
              boundaryInfoBox.appendChild(textAdd);
              const element = document.getElementById("districtList");
              const valueAdd = document.createElement('input')
              valueAdd.setAttribute('type', 'number')
              valueAdd.setAttribute('required','true')
              valueAdd.setAttribute('id', inputId)
              element.appendChild(boundaryInfoBox);
              boundaryInfoBox.appendChild(valueAdd);
              document.getElementById("districtList").style.width = '90vw'
              document.getElementById("districtList").style.display = 'grid'
              document.getElementById("districtList").style.gridTemplateColumns = "repeat(auto-fill,minmax(11vw, 1fr))"
              document.getElementById("districtList").style.alignSelf = 'centre'
              document.getElementById(boundaryId).style.backgroundColor = 'white'
              document.getElementById(boundaryId).style.display = 'flex'
              document.getElementById(boundaryId).style.flexWrap = 'Wrap'
              document.getElementById(boundaryId).style.boxShadow = '15px 10px 20px lightgrey'
              document.getElementById(boundaryId).style.color = 'darkGrey'
              document.getElementById(boundaryId).style.fontSize = '2rem'
              document.getElementById(boundaryId).style.margin = '1vh'
              document.getElementById(boundaryId).style.padding = '0.5vh'
              document.getElementById(boundaryId).style.borderRadius = '1vw'
              document.getElementById(boundaryId).style.width = '10vw'
              document.getElementById(boundaryId).style.height = '10vw'
              document.getElementById(boundaryId).style.opacity = 0.3
              document.getElementById(boundaryId).style.borderColor = 'white'
              document.getElementById(boundaryId).addEventListener('mouseover', function(){
                this.style.opacity = 0.8
                this.style.transition = '1s';
            })
              document.getElementById(boundaryId).addEventListener('mouseout', function(){
                this.style.opacity = 0.3
                this.style.transition = '1s';
            })
            councilDirectory = []
            var councils = []
              document.getElementById(boundaryId).addEventListener('click', function(e){
                console.log()
                var councilIDA = e.target.id
                var inputIdA = councilIDA + 'a'
                var councilID = councilIDA.slice(7)
                let seats = (document.getElementById(inputIdA).value)
                councils[0] = councilID
                for (let i = 0; i < councils.length; i++){
                  directory = '/assets/outputAreas/' + councils[i] + '.json'
                  councilDirectory[i] = directory
                  localStorage.setItem('councilDirectory', JSON.stringify(councilDirectory))
                  localStorage.setItem('councils', JSON.stringify(councils))
                  localStorage.setItem('seats', seats)
                }
                window.location.href = "/map.php";
                checknow()
                return false;
            })
          };
        }
          districtListing(councilNames, numCouncils)
      </script>
    </main>
  </body>
</html>
