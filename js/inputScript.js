function dnaInputCheck(element){
  value = element.value[element.value.length-1];
  value = value.toUpperCase();
  if (value !== "A" && value !== "G" && value !== "T" && value !== "C") {
    element.value = element.value.substr(0, element.value.length-1);
  }
}
/*Functions for selecting and delecting an input.*/
  function selected(element){
    if(pauseSelect === false){
      element.style.backgroundColor = "#EFEFEF";
    }
  }

  function deselected(element){
    if(pauseSelect === false){
      element.style.backgroundColor = "rgba(238, 238, 238, 0.7)";
    }
  }
/*Functions for removing and setting the default value for an input.*/
  function clearValue(element){
    if(element.value == element.getAttribute("info")){
      element.value = "";
    }
  }

  function restoreValue(element){
    if(element.value == ""){
      element.value = element.getAttribute("info");
    }
  }
