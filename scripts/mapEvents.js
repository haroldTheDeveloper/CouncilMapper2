const assign2 = function(District_ID, populations){
  for (let i = 0; i < populations.length; i++){
    if (District_ID == populations[i].ID){
      populations[i].Constituency = Constituency_ID
      console.log(populations[i].Constituency)
      return populations
      break
    }
  }
}

const populationDis = function(populations, District_ID){
  for (let i = 0; i < populations.length; i++){
    if (District_ID == populations[i].ID){
      return populations[i].AllAges;
      break
    }
  }
}

const colourSeat = function(layer, colours){
  colour = colours[Constituency_ID]
  console.log(colours)
  layer.setStyle({fillColor:colour, weight: 0})
}

const populationCalc = async function(){
  for (let i = 0; i < populations.length; i++){
    if (populations[i].Constituency == Constituency_ID){
      populations2[Constituency_ID] = populations2[Constituency_ID] + populations[i].AllAges
    }
  }
  return populations2
}

const renderMap = function(map, councilDirectory, colours){
  fetch(councilDirectory)
    .then(function(response) {
        return response.json();
    })
    .then(function(data) {
        L.geoJSON(data, {fillColor:'white', weight: 1, color: 'black'}).on('click', function(e){
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
                if (countOnClick == null){
                  var newData = data
                  newData = assign2(District_ID, newData)
                }
                if (countOnClick == null){
                  countOnClick = 1
                }
                newData = assign2(District_ID, newData)
                populationID = populationDis(newData, District_ID)
                colourSeat(layer, colours)
                populations2 = populationCalc()
                console.log(populations2)
              })
            }).on('keydown', function(e){
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
                    if (countOnClick == null){
                      var newData = data
                      newData = assign2(District_ID, newData)
                    }
                    if (countOnClick == null){
                      countOnClick = 1
                    }
                    newData = assign2(District_ID, newData)
                    populationID = populationDis(newData, District_ID)
                    colourSeat(layer, colours)
                    populations2 = populationCalc()
                    console.log(populations2)
                  })
                }).on('contextmenu', function(ev) {
              return false;
            }, false)
        .addTo(map);
    })
  }

  const calculateTotalPopulation = async function(councils){
    fetch("/assets/Populations/Populations.json")
    .then(function(response){
      return response.json()
    })
    .then(function(data){
      var population = 0
      var tempPop = 0
      for (let i = 0; i < councils.length; i++){
        for (let y = 0; y < data.length; y++){
          if (councils[i]==data[i].ID){
            tempPop = data[i].AllAges + population
            population = tempPop
          }
        }
      }
      return population
    })
  }
