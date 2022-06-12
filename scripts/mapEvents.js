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
  layer.setStyle({fillColor:colour, color:colour, weight: 0.6, fillOpacity: 0.7})
  if (Constituency_ID == 0){
    layer.setStyle({fillColor:colour, weight: 1, fillOpacity: 0})
  }
}

const populationCalc = function(data, quota){
  if (Constituency_ID != 0){
    populations2[Constituency_ID] = 0
  }
  for (let i = 0; i < data.length; i++){
    if (data[i].Constituency == Constituency_ID && Constituency_ID != 0){
      populations2[Constituency_ID] = populations2[Constituency_ID] + data[i].AllAges
      popDistrictId = 'Pop' + 'district' + Constituency_ID
      var quotaDistrictId = 'deviance' + 'district' + Constituency_ID
      document.getElementById(popDistrictId).innerHTML =  populations2[Constituency_ID]
      var currentDev = (quota - populations2[Constituency_ID])
      var bottomQuota = ((quota/100)*15)
      var topQuota = ((quota/100)*(-15))
      if (bottomQuota > currentDev && topQuota < currentDev){
        document.getElementById(quotaDistrictId).style.color = 'green'
      } else {
        document.getElementById(quotaDistrictId).style.color = 'red'
      }
      document.getElementById(quotaDistrictId).innerHTML =  parseInt((quota - populations2[Constituency_ID])*-1)
    }
  }
  return populations2
}

const renderMap = function(map, councilDirectory, colours, quota){
  console.log(colours)
  fetch(councilDirectory)
    .then(function(response) {
        return response.json();
    })
    .then(function(data) {
      var count = 0
        L.geoJSON(data, {fillColor:'lightgrey', weight: 1, color: 'black', fillOpacity: 0.7, draggable: false}).on('mouseover', function(e){
          var layer = e.sourceTarget;
          layer.setStyle({ fillOpacity: 0.9})
        }).on('mouseout', function(e){
          var layer = e.sourceTarget;
          layer.setStyle({fillOpacity: 0.7})
        }).on('mousedown', function(e){
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
                populations2 = populationCalc(newData, quota)
                console.log(populations2)
              })
            }).on('contextmenu', function(ev) {
              return false;
            }, false)
        .addTo(map);
    })
  }

  const calculateTotalPopulation = async function(councils, councilDirectory){
    var population3 = 0
    var directory = councilDirectory[0]
    var response = await fetch(directory, {method:'GET'})
    const geojsonData = await response.json()
    response = await fetch("/assets/Populations/Populations.json", {method: 'GET'})
    const populationData = await response.json()
    for (let i = 0; i < councils.length; i++){
      var codes = []
      for (let x = 0; x < geojsonData.features.length; x++){
        codes[x] = geojsonData.features[x].properties.OA11CD
      }
      for (let y = 0; y < populationData.length; y++){
        for (let x = 0; x < codes.length; x++){
          if (codes[x]==populationData[y].ID){
            population3 = populationData[y].AllAges + population3
        }
      }
    }
  }
  return population3
}
