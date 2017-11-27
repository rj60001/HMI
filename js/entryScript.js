window.onload = init;

function init() {
  enterBtn = document.getElementById("enterBtn");
  bgObjs = document.getElementsByName("bgObj");
  bgObjCon = document.getElementById("bgObjCon");
  menu = document.getElementById("mainCon");
  body = document.getElementsByTagName("BODY")[0];
  if(document.cookie.substring(document.cookie.indexOf("accessedBefore=TRUE"), document.cookie.indexOf("accessedBefore=TRUE")+19) === "accessedBefore=TRUE"){
    document.getElementsByTagName("HEAD")[0].innerHTML += '<style> #bgObjCon, #enterBtnCon {display: none;}</style>';
    menuPopUp(enterBtn, bgObjs, bgObjCon, menu, body);
  }
  enterBtn.onclick = function(){
    menuPopUp(enterBtn, bgObjs, bgObjCon, menu, body);
    document.cookie = "accessedBefore=TRUE;";
  }
  closeBtnClick();
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
  if(time === "day") {
    body.style.background = "linear-gradient(45deg, #17EA29, #16A7E5, #17EA29)";
    body.style.backgroundSize = "400% 400%";
    body.style.backgroundPosition = "0% 100%";
    body.style.color = "#FEFEFE";

    objects = document.getElementsByName("title");
    for(i = 0; i < objects.length; i++){
      objects[i].style.color = "#FFB71C";
    }
    objects = document.getElementsByName("subTitle");
    for(i = 0; i < objects.length; i++){
      objects[i].style.color = "#FEFEFE";
    }
    objects = document.getElementsByTagName("fieldset");
    for(i = 0; i < objects.length; i++){
      objects[i].style.color = "#EFEFEF";
      objects[i].style.borderColor = "#EFEFEF";
    }
    objects = document.getElementsByName("button");
    for(i = 0; i < objects.length; i++){
      objects[i].style.color = "#EFEFEF";
        objects[i].style.borderColor = "#EFEFEF";
    }
    objects = document.getElementsByTagName("input");
    for(i = 0; i < objects.length; i++){
      objects[i].style.color = "#16A7E5";
      objects[i].style.borderColor = "#EFEFEF";
      objects[i].style.backgroundColor = "#EFEFEF";
    }
    objects = document.getElementsByClassName("button");
    for(i = 0; i < objects.length; i++){
      objects[i].style.color = "#EFEFEF";
      objects[i].style.backgroundColor = "rgba(0, 0, 0, 0)";
    }
    objects = document.getElementsByTagName("textarea");
    for(i = 0; i < objects.length; i++){
      objects[i].style.color = "#16A7E5";
    }
    objects = document.getElementsByTagName("select");
    for(i = 0; i < objects.length; i++){
      objects[i].style.color = "#16A7E5";
      objects[i].style.borderColor = "#EFEFEF";
      objects[i].style.backgroundColor = "#EFEFEF";
    }

    css = ".button:hover { background-color: #EFEFEF !important; color: #16A7E5 !important; }";
    style = document.createElement("style");
    style.appendChild(document.createTextNode(css));
    document.getElementsByTagName("head")[0].appendChild(style);
  }
  else if(time === "night"){
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
    objects = document.getElementsByClassName("button");
    for(i = 0; i < objects.length; i++){
      objects[i].style.color = "#999";
      objects[i].style.backgroundColor = "rgba(0, 0, 0, 0)";
    }
    objects = document.getElementsByTagName("textarea");
    for(i = 0; i < objects.length; i++){
      objects[i].style.color = "#444";
    }
    objects = document.getElementsByTagName("select");
    for(i = 0; i < objects.length; i++){
      objects[i].style.color = "#444";
      objects[i].style.borderColor = "#999";
      objects[i].style.backgroundColor = "#999";
    }
    css = ".button:hover { background-color: #999 !important; color: #444 !important; }";
    style = document.createElement("style");
    style.appendChild(document.createTextNode(css));
    document.getElementsByTagName("head")[0].appendChild(style);
  }
}


function dayChangeClick(){
  body = document.getElementsByTagName("body")[0];
  btn = document.getElementById("dayChangeBtn");
  if(btn.getAttribute("info") === "day") {
    setColorScheme("night");
    btn.setAttribute("info", "night");
    btn.innerHTML = '<i class="material-icons">brightness_1</i>';
  }
  else if(btn.getAttribute("info") !== "day") {
    setColorScheme("day");
    btn.setAttribute("info", "day");
    btn.innerHTML = '<i class="material-icons">brightness_3</i>';
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
