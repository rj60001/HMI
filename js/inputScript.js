function dnaInputCheck(element){
  value = element.value[element.value.length-1];
  value = value.toUpperCase();
  if (value !== "A" && value !== "G" && value !== "T" && value !== "C") {
    console.log("poo");
    element.value = element.value.substr(0, element.value.length-1);
  }
}

function clearValue(value){
  if(value.value == value.getAttribute("info")){
    value.value = "";
  }
}

function restoreValue(value){
  if(value.value == ""){
    x = value.getAttribute("info");
    value.value = x;
  }
}
