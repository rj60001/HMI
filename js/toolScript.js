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
