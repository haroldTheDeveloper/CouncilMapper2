const assign2 = function(District_ID, Constituency_ID, populations){
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

const colourSeat = function(layer, Constituency_ID, colours){
  colour = colours[Constituency_ID]
  layer.setStyle({fillColor:colour, weight: 0})
}

const populationCalc = async function(Constituency_ID, populations, populations2){
  populations2[0] = 0
  for (let i = 0; i < populations.length; i++){
    if (populations[i].Constituency == Constituency_ID){
      console.log(populations[i].Constituency)
      populations2[Constituency_ID] += populations[i].AllAges
    }
  }
  console.log(populations2)
  return populations2
}

const renderMap = async function(map, councilDirectory){
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
                  newData = assign2(District_ID, Constituency_ID, newData)
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
                newData = assign2(District_ID, Constituency_ID, newData)
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
                  var data = assign2(District_ID, Constituency_ID, data)
                  colourSeat(layer, Constituency_ID, colours)
                  var populations2 = populationCalc(Constituency_ID, data, populations2)
                })
            }, false)
        .addTo(map);
    })
  }
