window.onload = init;

function init() {
  enterBtn = document.getElementById("enterBtn");
  bgObjs = document.getElementsByName("bgObj");
  bgObjCon = document.getElementById("bgObjCon");
  menu = document.getElementById("mainCon");
  body = document.getElementsByTagName("BODY")[0];
  enterBtn.onclick = function(){
    menuPopUp(enterBtn, bgObjs, bgObjCon, menu, body);
  }
}

function randint(min, max) {
  return Math.floor(Math.random() * ((max-min) +1)) + min;
}

function menuPopUp(enterBtn, bgObjs, bgObjCon, menu, body) {
  enterBtn.style.animationName = "flyAway";
  enterBtn.style.animationDuration = "7s";
  enterBtn.style.animationIterationCount = "1";
  for(i = 0; i < bgObjs.length; i++) {
    bgObjs[i].style.animationFillMode = "forwards";
    bgObjs[i].style.animationIterationCount = "1";
    bgObjs[i].style.animationDuration = String(randint(3, 12))+'s';
    bgObjs[i].style.animationName = "flyAway";
  }
  menu.style.animationName = "fadeIn";
  setTimeout(function(){
    bgObjCon.innerHTML = "";
    enterBtn.style.display = "None";
    texts = document.getElementsByName("text");
    for (i = 0; i < texts.Length; i++) {
      texts[i].style.paddingRight = "-1%";
    }
  }, 3000);
}

function setColorScheme(time){
  objectNameList = ["title", "subTitle", "button"];
  objectTagList = ["fieldset", "input", "select", "textarea"];
  finalList = [];
  finalNumList = [];
  for(i = 0; i < objectNameList.length; i++) {
    array = document.getElementsByName(objectNameList[i]);
    console.log(array);
    finalList = finalList.concat(array);
    finalNumList.push(array.length);
  }
  for(i = 0; i < objectTagList.length; i++) {
    array = document.getElementsByTagName(objectTagList[i]);
    finalList = finalList.concat(array);
    finalNumList.push(array.length);
  }
  finalTotalNum = 0;
  for(i = 0; i < finalNumList.length; i++) {
    finalTotalNum += finalNumList[i];
  }
  console.log(finalList);
  console.log(finalNumList);
  if(time === "day") {
    for(i = 0; i < finalTotalNum; i++) {
      if(i <= finalNumList[0]){
        finalList[i][i].style.color = "#FFB71C";
      }
      else if(i <= finalNumList[1] && i > finalNumList[0]){
        finalList[i].style.color = "#FEFEFE";
      }
      else if(i <= finalNumList[2] && i > finalNumList[1]){
        finalList[i].style.color = "#EFEFEF";
        finalList[i].style.borderColor = "#EFEFEF";
      }
      else if(i <= finalNumList[3] && i > finalNumList[2]){
        finalList[i].style.color = "#EFEFEF";
        finalList[i].style.borderColor = "#EFEFEF";
      }
      else if(i <= finalNumList[4] && i > finalNumList[3]){
        finalList[i].style.color = "#16A7E5";
        finalList[i].style.borderColor = "#EFEFEF";
        finalList[i].style.backgroundColor = "#EFEFEF";
      }
      else if(i <= finalNumList[5] && i > finalNumList[4]){
        finalList[i].style.color = "#16A7E5";
        finalList[i].style.borderColor = "#EFEFEF";
        finalList[i].style.backgroundColor = "#EFEFEF";
      }
      else if(i <= finalNumList[6] && i > finalNumList[5]){
        finalList[i].style.color = "#16A7E5";
        finalList[i].style.borderColor = "#EFEFEF";
        finalList[i].style.backgroundColor = "#EFEFEF";
      }
    }
  }
  else if(time === "night"){
    /*w*/
  }
}


function dayChangeClick(){
  body = document.getElementsByTagName("body")[0];
  btn = document.getElementById("dayChangeBtn");
  if(btn.getAttribute("info") === "day") {
    body.style.background = "#333";
    body.style.color = "#777";
    objects = document.getElementsByName("title");
    for(i = 0; i < objects.length; i++){
      objects[i].style.color = "#BBB";
    }
    objects = document.getElementsByName("subTitle");
    for(i = 0; i < objects.length; i++){
      objects[i].style.color = "#999";
    }
    objects = document.getElementsByTagName("fieldset");
    for(i = 0; i < objects.length; i++){
      objects[i].style.color = "#777";
      objects[i].style.borderColor = "#999";
    }
    objects = document.getElementsByName("button");
    for(i = 0; i < objects.length; i++){
      objects[i].style.color = "#999";
      objects[i].style.borderColor = "#999";
    }
    objects = document.getElementsByTagName("input");
    for(i = 0; i < objects.length; i++){
      objects[i].style.color = "#444";
      objects[i].style.borderColor = "#999";
      objects[i].style.backgroundColor = "#999";
    }
    objects = document.getElementsByTagName("textarea");
    for(i = 0; i < objects.length; i++){
      objects[i].style.color = "#444";
      objects[i].style.borderColor = "#999";
      objects[i].style.backgroundColor = "#999";
    }
    objects = document.getElementsByTagName("select");
    for(i = 0; i < objects.length; i++){
      objects[i].style.color = "#444";
      objects[i].style.borderColor = "#999";
      objects[i].style.backgroundColor = "#999";
    }
    css = ".button:hover { background-color: #999; color: #444 !important; }";
    style = document.createElement("style");
    style.appendChild(document.createTextNode(css));
    document.getElementsByTagName("head")[0].appendChild(style);
    btn.setAttribute("info", "night");
    btn.innerHTML = '<i class="material-icons">brightness_1</i>';
  }
  else if(btn.getAttribute("info") !== "day") {
    body.style.background = "linear-gradient(45deg, #17EA29, #16A7E5, #17EA29)";
    body.style.backgroundSize = "400% 400%";
    body.style.backgroundPosition = "0% 100%";
    body.style.color = "#FEFEFE";
    setColorScheme("day");
    css = ".button:hover { background-color: #EFEFEF; color: #16A7E5 !important; }";
    style = document.createElement("style");
    style.appendChild(document.createTextNode(css));
    document.getElementsByTagName("head")[0].appendChild(style);
    btn.setAttribute("info", "day");
    btn.innerHTML = '<i class="material-icons">brightness_3</i>';
  }
}
