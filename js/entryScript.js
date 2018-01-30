window.onload = init; // Once the window has loaded call the function init().

function init() {
  pauseSelect = false; // This pauses the select() and deSelect() functions when set to true.
  enterBtn = document.getElementById("enterBtn"); // Get the values of the attributes on the element with ID "enterBtn".
  bgObjs = document.getElementsByName("bgObj");
  bgObjCon = document.getElementById("bgObjCon");
  menu = document.getElementById("mainCon");
  body = document.getElementsByTagName("BODY")[0]; // Gets the values of the attributes of the body element.
  if(document.cookie.substring(document.cookie.indexOf("accessedBefore=TRUE"), document.cookie.indexOf("accessedBefore=TRUE")+19) === "accessedBefore=TRUE"){
    // The above line of code checks if accessedBefore=True is in the cookie string set by the website by taking a substring, defined by two indicies.
    // x.indexOf(y) fetches the index of the beginning character of the string y, if y can be found as a substring within the string x.
    menuPopUp(enterBtn, bgObjs, bgObjCon, menu); // If the above is true show the main screen. This is used in conjunction with some code on index.php that prevents the first-load screen from displaying.
  }
  else { //If this is the first time we have accessed the site.
    document.cookie = "colorMode=day;"; // Set a cookie to set the theme of the website to daytime.
  }
  enterBtn.onclick = function(){ // When the first-load enterBtn is clicked (only displayed if this is the first time we have accessed the website so no need to put it in an if statement.)
    menuPopUp(enterBtn, bgObjs, bgObjCon, menu); // Displays the main screen.
    document.cookie = "accessedBefore=TRUE;"; // Set a new cookie that teels us to automatically move pass the first-load screne
  }
  btn = document.getElementById("dayChangeBtn");
  loadColorScheme(btn);
  closeBtnClick();
}

function randint(min, max) { // Generate a random positive integer between the minimum and maximum values.
  return Math.floor(Math.random() * ((max-min) +1)) + min;
  /* Above line rounds down the number given. Math.random() generates a random float between 0 and 1.
     We find the difference of the two ranges. We add one so that we do not have a floor result of zero and therfore have a value that is always greater than the minimum value.
     We then add the minimum value to the floored result so that it is within the range we wanted.*/
}

function menuPopUp(enterBtn, bgObjs, bgObjCon, menu) { // Displays the main screen.
  enterBtn.style.animationName = "flyAway"; // Sets the button neccessary for entering the website, to have an animation. This triggers the animation to start automatically.
  enterBtn.style.animationDuration = "7s";
  enterBtn.style.animationIterationCount = "1";
  for(i = 0; i < bgObjs.length; i++) { // For all of the objects BESIDES the enterBtn that makes up our first load screen.
    bgObjs[i].style.animationFillMode = "forwards";
    bgObjs[i].style.animationIterationCount = "1";
    bgObjs[i].style.animationDuration = String(randint(3, 12))+'s'; // Gives each one a random animation duration.
    bgObjs[i].style.animationName = "flyAway";
  }
  menu.style.animationName = "fadeIn"; // This lets the main screen fade into being displayed.
  setTimeout(function(){
    bgObjCon.innerHTML = ""; // Remove all of the elements within the first load screen so less memory is used.
    enterBtn.style.display = "None"; // Prevent the enter button from being displaued/
  }, 3000); // setTimeOut executes a function after an amoutn of time in milliseconds.
}

function setColorScheme(mode){ // The sets the theme of the website. mode=the colorscheme we want to switch to.
  sheetEle = document.createElement("style"); // This creates a sttyle element.
  document.head.appendChild(sheetEle); // Append the element to be nested within the head tag.
  sheet = sheetEle.sheet; // Get the sheet element that has been nested within the head element.
  elements = document.getElementsByTagName("*"); // Fetch ALL elements.
  colorsTypes = ["color", "backgroundColor", "boxShadow"];
  menuCon = document.getElementById("menuCon").style; // Get the style attribute content of the element with ID menuCon.
  menuIcons = document.getElementsByTagName("i"); // Gets the menu icons as they use the Google icons syntax which requires being wrapped in i tags.
  mainCon = document.getElementById("mainCon");
  if(mode === "night"){
    sheet.insertRule("button:hover, input:hover, select:hover, textarea:hover  {background-color: #333 !important;border-color: #333 !important;}",0); // This adds a new rule to the sheet eleemnt we created earlier.
    sheet.insertRule("#mainCon::-webkit-scrollbar {background-color: rgb(51, 51, 51);}", 1); // The scollbar is a pseudo-element so I had to insert a new rule.)
    sheet.insertRule("#mainCon::-webkit-scrollbar-thumb {background-color: rgb(239, 239, 239);}", 2); // Ditto
    pauseSelect = true; // This means that select and deSelect are now disabled.
    for(i=0;i<elements.length;i++){ // For each element.
      colors = [window.getComputedStyle(elements[i]).getPropertyValue("color"), window.getComputedStyle(elements[i]).getPropertyValue("background-color"), window.getComputedStyle(elements[i]).getPropertyValue("box-shadow")];
      // window.getComputedStyle(x).getPropertyValue(y) fetches the value of style property y, from the element x.
      for(j=0;j<colors.length;j++){ // Go through the colors for each element.
        switch(colors[j]){ // Check the value of the computed style.
          case "rgb(239, 239, 239)":
            eval('elements[i].style.'+colorsTypes[j]+' = "rgb(51, 51, 51)";'); // We use the colorTypes array to fetch the current attribute name so that we can assign a value to it
            break;                                                             // on the fly instead of hardcoding each possibility of attribute/value pair (125 pairs).
          case "rgba(239, 239, 239, 0.7)":
            eval('elements[i].style.'+colorsTypes[j]+' = "rgba(51, 51, 51, 0.7)";'); // eval(x) execute the string x as if it was JavaScipt code.
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
    menuCon.backgroundColor = "rgb(64, 64, 64)"; // Menu bar is set tot be slightly lighter than the backgorund so that it can be clearly seen.
  }
  else if(mode === "day"){
    pauseSelect = false; // Enables the select and deselct functions to be used.
    sheet.insertRule("button:hover, input:hover, select:hover, textarea:hover  {background-color: #EFEFEF !important;border-color: #444 !important;}",0);
    sheet.insertRule("#mainCon::-webkit-scrollbar {background-color: rgb(239, 239, 239);}", 1);
    sheet.insertRule("#mainCon::-webkit-scrollbar-thumb {background-color: rgb(51, 51, 51);}", 2);
    for(i=0;i<elements.length;i++){
      colors = [window.getComputedStyle(elements[i]).getPropertyValue("color"), window.getComputedStyle(elements[i]).getPropertyValue("background-color"), window.getComputedStyle(elements[i]).getPropertyValue("box-shadow")];
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
          case "rgb(0, 0, 0) 7px 7px 17px 0px":
            eval('elements[i].style.'+colorsTypes[j]+' = "7px 7px 17px rgb(170, 170, 170)";');
            break;
          default:
            break;
        }
      }
    }
    menuCon.backgroundColor = "rgb(51, 51, 51)";
  }
  signOutBtn = document.getElementById("signOutBtn");
  if(signOutBtn){
    signOutBtn.innerHTML = "<p style='color:#EFEFEF;'>Sign out</p>"; // Maintains the colour of the text within the sign out button.
  }
  for(i=0;i<menuIcons.length;i++){ // Maintains the colour for the icons withinnthe menu.
    menuIcons[i].style.color = "rgb(239, 239, 239)";
  }
}

function loadColorScheme(btn){ // Used when index.php loads to load the currently set colour scheme.
  colourMode = document.cookie.substring(document.cookie.indexOf("colorMode"), document.cookie.indexOf("colorMode")+11); // Get the value of the cookie that is set to define the colour mode.
  if(colourMode === "colorMode=n") { //If it is in night mode, set the dayChange icon to a picture of a sun and change the theme of the website to night mode.
    btn.innerHTML = '<i class="material-icons">brightness_1</i>';
    setColorScheme("night");
  }
  // If it is inday mode, we do not need to load a new colour scheme as it the website is in day mode by default.
}

function dayChangeClick(){ // Used after index.php has loaded. loadColorScheme cannot be used for a simple solution as it only reads the cookie and does not set it as well as the fact that it cannot deal with loading a colour change to day mode.
  btn = document.getElementById("dayChangeBtn");
  if(document.cookie.substring(document.cookie.indexOf("colorMode"), document.cookie.indexOf("colorMode")+11) === "colorMode=n"){ // Get the colour mode cookie.
    document.cookie = "colorMode=day;"; // Set that cookie to the new value.
    setColorScheme("day")
    btn.innerHTML = '<i class="material-icons">brightness_3</i>';
  }
  else {
    document.cookie = "colorMode=night;";
    setColorScheme("night");
    btn.innerHTML = '<i class="material-icons">brightness_1</i>';
  }
}

function closeBtnClick(){ // Closes all notification tabs when clicked. Not possible for more than one pop up, so closing all notifixation is sensible.
  crosses = document.getElementsByClassName("crossPU");
  tabs = document.getElementsByClassName("boardConPU");
  for(i=0;i < crosses.length; i++){
    crosses[i].onclick = function(){ // If any one of the crosses are clicked
      for(j=0;j < tabs.length; j++){ // Every tab is...
        tabs[j].style.display = "none"; // set to not display.
      }
    }
  }
}

function reload(){ // One method of reloading a page. Reload the page if the laoded hash query is not in the URL, but before reloading add that #loaded to prevent further reloads.
  if(!window.location.hash){
    window.location += "#loaded";
    window.location.reload();
  }
}
