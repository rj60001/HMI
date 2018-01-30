function addHmod(name, id, display = "hmodSequence", list = "histoneModsT"){ // Defaults for output. display is where the list of mods is shown to the user. list is the actual list of ids that we will use in processing.
  document.getElementById(display).innerHTML += String(name)+" ";
  document.getElementById(list).value += String(id)+",";
}

function removeLastHmod(display = "hmodSequence", list = "histoneModsT"){
  text = document.getElementById(display);
  list = document.getElementById(list);
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

function split(display = "hmodSequence", list = "histoneModsT"){
  text = document.getElementById(display);
  list = document.getElementById(list);
  text.innerHTML += " | ";
  list.value += "|";
}
