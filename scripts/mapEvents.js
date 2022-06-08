const assign = function(District_ID, Constituency_ID, populations){
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
