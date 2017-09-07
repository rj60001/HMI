function dnaInputCheck(element){
  value = element.value.slice[-1];
  if (value !== "A" || value !== "G" || value !== "T" || value !== "C") {
    console.log("poo");
    element.value.slice(0, element.value.length-1);
  }
}
