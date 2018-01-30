function addHmod(name, id, display = "hmodSequence", list = "histoneModsT"){
  // Defaults for output: display is where the list of mods is shown to the user. list is the actual list of ids that we will use in processing.
  document.getElementById(display).innerHTML += String(name)+" "; // Add the histone modification name to the display div.
  document.getElementById(list).value += String(id)+","; // Append the id of the histone modification tothe hidden input list.
}

function removeLastHmod(display = "hmodSequence", list = "histoneModsT"){
  text = document.getElementById(display);
  list = document.getElementById(list);
  mods = text.innerHTML.split(" "); // Splits up all of the dsiplay mod names.
  ids = list.value.split(","); // Splits up the list of ids.
  mods.splice(mods.lengths-1, 1); // Removes the last name from the display.
  ids.splice(ids.lengths-1, 1); // Removes the last id from the list.
  final = "";
  for(i=0;i<mods.length;i++){
    final += String(mods[i])+" "; // Append each mod name with a space at the end to create the name name display.
  }
  text.innerHTML = final; // Set the HTML content of the display to the new sequence of mod names.
  list.value = String(ids);
}

function split(display = "hmodSequence", list = "histoneModsT"){ // | Signifies the end of one nucleosome and the beginning of another.
  text = document.getElementById(display);
  list = document.getElementById(list);
  text.innerHTML += " | ";
  list.value += "|";
}
