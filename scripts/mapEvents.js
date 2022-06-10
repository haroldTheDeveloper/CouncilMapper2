const assign2 = function(District_ID, data){
  for (let i = 0; i < data.length; i++){
    if (District_ID == data[i].ID){
      data[i].Constituency = Constituency_ID
      console.log(data[i].Constituency)
      return data
      break
    }
  }
}

const populationDis = function(District_ID){
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

const populationCalc = function(data){
  populations2[Constituency_ID] = 0
  for (let i = 0; i < data.length; i++){
    if (data[i].Constituency == Constituency_ID){
      populations2[Constituency_ID] = populations2[Constituency_ID] + data[i].AllAges
      popDistrictId = 'Pop' + 'district' + Constituency_ID
      document.getElementById(popDistrictId).innerHTML =  populations2[Constituency_ID]
    }
  }
  return populations2
}

const renderMap = function(map, councilDirectory, colours, newData){
  fetch(councilDirectory)
    .then(function(response) {
        return response.json();
    })
    .then(function(data) {
      var count = 0
        L.geoJSON(data, {fillColor:'white', weight: 1, color: 'black', fillOpacity: 0.6}).on('click', function(e){
            count += 1
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
                if (count == 1){
                  newData = data
                }
                if (countOnClick == null){
                  countOnClick = 1
                }
                newData = assign2(District_ID, newData)
                console.log(newData)
                populationID = populationDis(newData, District_ID)
                colourSeat(layer, colours)
                populations2 = populationCalc(newData)
                console.log(populations2)
              })
            }).on('contextmenu', function(ev) {
              return false;
            }, false)
        .addTo(map);
    })
  }

  const calculateTotalPopulation = function(councils){
    fetch("/assets/Populations/Populations.json")
    .then(function(response){
      return response.json()
    })
    .then(function(data){
      var population = 0
      for (let i = 0; i < councils.length; i++){
        for (let y = 0; y < data.length; y++){
          if (councils[i]==data[y].IDLocal){
            population = data[y].AllAges + population
          }
        }
      }
      return population
    })
  }
