const assign = async function(District_ID, Constituency){
}

const populations_Parse = async function(file){
  var data = $.csv.toObjects(file);
  return data
}

const population = function(populations, District_ID){
  for (let i = 0; i < populations.length; i++){
    if (District_ID == populations[i].ID){
      return populations[i].AllAges;
      break
    }
  }
}
