window.onload = init;

function init() {
  pauseSelect = false; /*This tells us if the select/deSelect functions are enables/disable with FALSE and TRUE respectively.*/
  enterBtn = document.getElementById("enterBtn");
  bgObjs = document.getElementsByName("bgObj");
  bgObjCon = document.getElementById("bgObjCon");
  menu = document.getElementById("mainCon");
  body = document.getElementsByTagName("BODY")[0];
  if(document.cookie.substring(document.cookie.indexOf("accessedBefore=TRUE"), document.cookie.indexOf("accessedBefore=TRUE")+19) === "accessedBefore=TRUE"){
    menuPopUp(enterBtn, bgObjs, bgObjCon, menu);
  }
  else {
    document.cookie = "colorMode=day;";
  }
  enterBtn.onclick = function(){
    menuPopUp(enterBtn, bgObjs, bgObjCon, menu);
    document.cookie = "accessedBefore=TRUE;";
  }
  btn = document.getElementById("dayChangeBtn");
  loadColorScheme(btn);
  closeBtnClick();
}

function randint(min, max) {
  return Math.floor(Math.random() * ((max-min) +1)) + min;
}

function menuPopUp(enterBtn, bgObjs, bgObjCon, menu) {
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
function setColorScheme(mode){
  sheetEle = document.createElement("style");
  document.head.appendChild(sheetEle);
  sheet = sheetEle.sheet;
  elements = document.getElementsByTagName("*");
  colorsTypes = ["color", "backgroundColor", "boxShadow"];
  menuCon = document.getElementById("menuCon").style;
  menuIcons = document.getElementsByTagName("i");
  mainCon = document.getElementById("mainCon");
  if(mode === "night"){
    sheet.insertRule("button:hover, input:hover, select:hover, textarea:hover  {background-color: #333 !important;border-color: #333 !important;}",0);
    sheet.insertRule("#mainCon::-webkit-scrollbar {background-color: rgb(51, 51, 51);}", 1); /*For this scollbar (is a pseudo-element so I had to insert a new rule.)*/
    sheet.insertRule("#mainCon::-webkit-scrollbar-thumb {background-color: rgb(239, 239, 239);}", 2); /*Ditto*/
    pauseSelect = true;
    for(i=0;i<elements.length;i++){
      colors = [window.getComputedStyle(elements[i]).getPropertyValue("color"), window.getComputedStyle(elements[i]).getPropertyValue("background-color"), window.getComputedStyle(elements[i]).getPropertyValue("box-shadow"), window.getComputedStyle(elements[i]).getPropertyValue("outline-color")];
      for(j=0;j<colors.length;j++){
        switch(colors[j]){
          case "rgb(239, 239, 239)":
            eval('elements[i].style.'+colorsTypes[j]+' = "rgb(51, 51, 51)";');
            break;
          case "rgba(239, 239, 239, 0.7)":
            eval('elements[i].style.'+colorsTypes[j]+' = "rgba(51, 51, 51, 0.7)";');
            break;
          case "rgba(238, 238, 238, 0.7)":
            eval('elements[i].style.'+colorsTypes[j]+' = "rgba(51, 51, 51, 0.7)";');
            break;
          case "rgb(51, 51, 51)":
            eval('elements[i].style.'+colorsTypes[j]+' = "rgb(239, 239, 239)";');
            break;
          case "rgb(170, 170, 170) 7px 7px 17px 0px": /*For any box-shadows.*/
            eval('elements[i].style.'+colorsTypes[j]+' = "7px 7px 17px rgb(0, 0, 0)";');
            break;
          default:
            break;
        }
      }
    }
    menuCon.backgroundColor = "rgb(64, 64, 64)";
  }
  else if(mode === "day"){
    pauseSelect = false;
    sheet.insertRule("button:hover, input:hover, select:hover, textarea:hover  {background-color: #EFEFEF !important;border-color: #444 !important;}",0);
    sheet.insertRule("#mainCon::-webkit-scrollbar {background-color: rgb(239, 239, 239);}", 1); /*For this scollbar (is a pseudo-element so I had to insert a new rule.)*/
    sheet.insertRule("#mainCon::-webkit-scrollbar-thumb {background-color: rgb(51, 51, 51);}", 2); /*Ditto*/
    for(i=0;i<elements.length;i++){
      colors = [window.getComputedStyle(elements[i]).getPropertyValue("color"), window.getComputedStyle(elements[i]).getPropertyValue("background-color"), window.getComputedStyle(elements[i]).getPropertyValue("box-shadow"), window.getComputedStyle(elements[i]).getPropertyValue("outline-color")];
      for(j=0;j<colors.length;j++){
        switch(colors[j]){
          case "rgb(239, 239, 239)":
            eval('elements[i].style.'+colorsTypes[j]+' = "rgb(51, 51, 51)";');
            break;
          case "rgba(51, 51, 51, 0.7)":
            eval('elements[i].style.'+colorsTypes[j]+' = "rgba(239, 239, 239, 0.7)";');
            break;
          case "rgb(51, 51, 51)":
            eval('elements[i].style.'+colorsTypes[j]+' = "rgb(239, 239, 239)";');
            break;
          case "rgb(0, 0, 0) 7px 7px 17px 0px": /*For any box-shadows.*/
            eval('elements[i].style.'+colorsTypes[j]+' = "7px 7px 17px rgb(170, 170, 170)";');
            break;
          default:
            break;
        }
      }
    }
    menuCon.backgroundColor = "rgb(51, 51, 51)";
  }

  document.getElementById("signOutBtn").innerHTML = "<p style='color:#EFEFEF;'>Sign out</p>"
  for(i=0;i<menuIcons.length;i++){ /*Maintains the colour for the menuIcons.*/
    menuIcons[i].style.color = "rgb(239, 239, 239)";
  }
}

function loadColorScheme(btn){ /*Used when index.php loads.*/
  colourMode = document.cookie.substring(document.cookie.indexOf("colorMode"), document.cookie.indexOf("colorMode")+11);
  if(colourMode === "colorMode=n") {
    btn.innerHTML = '<i class="material-icons">brightness_1</i>';
    setColorScheme("night");
  }
  else if(colourMode === "colorMode=d") {
    btn.innerHTML = '<i class="material-icons">brightness_3</i>';
    /* No need to change colour scheme if the mode is set to day as that is the default. */
  }
}

function dayChangeClick(){ /*Used after index.php has loaded.*/
  body = document.getElementsByTagName("body")[0];
  btn = document.getElementById("dayChangeBtn");
  if(document.cookie.substring(document.cookie.indexOf("colorMode"), document.cookie.indexOf("colorMode")+11) === "colorMode=n"){
    document.cookie = "colorMode=day;";
    setColorScheme("day"); /*loadColorScheme cannot be used for a simple solution as it is called only on index.php load.*/
    btn.innerHTML = '<i class="material-icons">brightness_3</i>';
  }
  else {
    document.cookie = "colorMode=night;";
    setColorScheme("night");
    btn.innerHTML = '<i class="material-icons">brightness_1</i>';
  }
}

function closeBtnClick(){
  crosses = document.getElementsByClassName("crossPU");
  tabs = document.getElementsByClassName("boardConPU");
  for(i=0;i < crosses.length; i++){
    crosses[i].onclick = function(){
      for(j=0;j < tabs.length; j++){
        tabs[j].style.display = "none";
      }
    }
  }
}

function reload(){
  if(!window.location.hash){
    window.location += "#loaded";
    window.location.reload();
  }
}
