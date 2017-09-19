function dnaInputCheck(element){
  value = element.value.slice[-1];
  if (value != "A" && value !== "G" && value != "T" && value != "C") {
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

function checkPassword(obj){
  match = true;
  if(obj.name = "passwordConSU"){
    if(obj.value != document.getElementById("passwordSU").value){
      match = false;
    }
  }
  if(obj.value.length < 6 || !match){
    obj.style.borderColor = "#FF0000";
    obj.style.color = "#FF0000";
  }
  else {
    obj.style.borderColor = "#EFEFEF";
    obj.style.color = "16A7E5";
  }
}
