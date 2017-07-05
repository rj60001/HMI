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
    body.style.overflow = "auto";
  }, 3000);
}
