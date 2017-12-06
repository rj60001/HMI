function addHmod(name, id){
  document.getElementById("hmodSequence").innerHTML += String(name)+" ";
  document.getElementById("histoneModsT").value += String(id)+",";
}

function removeLastHmod(){
  text = document.getElementById("hmodSequence");
  list = document.getElementById("histoneModsT");
  mods = text.innerHTML.split(" ");
  ids = list.value.split(",");
  mods.splice(mods.lengths-1, 1);
  ids.splice(ids.lengths-1, 1);
  final = "";
  for(i=0;i<mods.length;i++){
    final += String(mods[i])+" ";
  }
  text.innerHTML = final;
  list.value = String(ids);
}

function searchRedirect(id, disease, tool){ //tool when true means that we are searching for a sequence.
  url = "index.php?searchType=";
  if(tool === true){
    url += "tool&disease=";
    if(disease === false){
      url += "0";
    }
    else {
      url += "1";
    }
    url += "&sequence="+id;
  }
  else {
    url += "forum&thread="+id;
  }
  url += "&page=search";
  window.location.href = url;
}
