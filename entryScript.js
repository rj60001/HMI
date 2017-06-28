window.onload = init;

function init() {
  enterBtn = document.getElementById("enterBtn");
  bgObjs = document.getElementsByName("bgObj");
  bgObjCon = document.getElementById("bgObjCon");
  menu = document.getElementById("menuCon");
  enterBtn.onclick = function(){
    menuPopUp(enterBtn, bgObjs, bgObjCon, menu);
  }
}

function randint(min, max) {
  return Math.floor(Math.random() * ((max-min) +1)) + min;
}

function menuPopUp(enterBtn, bgObjs, bgObjCon, menu) {
  enterBtn.style.animationName = "flyAway";
  for(i = 0; i < bgObjs.length; i++) {
    bgObjs[i].style.animationFillMode = "forwards";
    bgObjs[i].style.animationIterationCount = "1";
    bgObjs[i].style.animationDuration = String(randint(3, 12))+'s';
    bgObjs[i].style.animationName = "flyAway";
  }
  menu.style.animationName = "fadeIn";
}
