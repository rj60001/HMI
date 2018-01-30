function dnaInputCheck(element){ // Ensures inputted DNA character is valid.
  value = element.value[element.value.length-1];
  value = value.toUpperCase(); // Converts all values to be upper case, as text-transform: capitalise does not change the value of the input to be capitalised. Capital form allows for less variety in the potential values for 'value'.
  if (value !== "A" && value !== "G" && value !== "T" && value !== "C" && value !== "N") { // N is for unidentified bases.
    element.value = element.value.substr(0, element.value.length-1); // If the character is not valid then we remove it.
  }
}
// Functions for selecting and delecting an input.
  function selected(element){
    if(pauseSelect === false){ // Only works if night mode is not enabled.
      element.style.backgroundColor = "#EFEFEF";
    }
  }

  function deselected(element){
    if(pauseSelect === false){
      element.style.backgroundColor = "rgba(238, 238, 238, 0.7)";
    }
  }
 // Functions for removing and setting the default value for an input
  function clearValue(element){ // Called when the user is focusing on the input.
    if(element.value == element.getAttribute("info")){ // Checks if the value of input is the same as its default value, denoted buy the attribute 'info'.
      element.value = "";
    }
  }

  function restoreValue(element){ // Called when the user is not focusing on the input.
    if(element.value == ""){
      element.value = element.getAttribute("info"); // Resets the default value if not data has been inputted.
    }
  }
