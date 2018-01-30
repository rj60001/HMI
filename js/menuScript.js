function menuBtnClick(value) { // Used to switch between pages. value represents the page the user has clicked on.
  document.getElementById("homePage").style.opacity = '0'; // Prevents the homePage from popping up everytime index.php loads to create a more seamless transition.
  postEle = document.getElementsByClassName("postBtn");
  if((value === "forum" || value === "forumSingleView") && document.cookie.substring(document.cookie.indexOf("user"), document.cookie.indexOf("user")+4) === "user"){ // If the user is logged in and one of the forumpages are being accessed.
    for(i=0;i < values.length; i++){
      postEle[i].style.display = "block"; // Display all post-related menu elements.
    }
  }
  else { // If any other page is being switched to.
    for(i=0;i < values.length; i++){
      postEle[i].style.display = "none";
    }
  }

  if(value === "forum" && window.location.href.indexOf("thread") != -1){ // If we are switching to the main forum page when threads are listed and the thread query is in our url.
    window.location.href = "index.php?page=forum"; // We reload the page because the user singleview page cannot have its contents altered unless we lod back into it AFTER we load into the forum page.
  }
  if((value === "forum" || value === "tool") && document.cookie.substring(document.cookie.indexOf("user"), document.cookie.indexOf("user")+4) !== "user"){
    // If the user is not signed in and is trying to access one of the restricted pages, break out of the fucntion so tjhat they cannot switch to those pages.
    return 0;
  }
  value += "Page";
  page = document.getElementById(value).style; // Get the style attributes of the page we are truing to switch to.
  pages = ["homePage", "accountPage", "toolPage", "newsPage", "aboutPage", "forumPage", "forumSingleViewPage", "toolSingleViewPage", "searchPage"];
  pages.splice(pages.indexOf(value), 1); // Remove the page we are trying to switch to from the pages array.
  for(i = 0; i < pages.length; i++){
    document.getElementById(pages[i]).style.animationName = "fadeOut"; // Animates the pages we are not switching to, to fade out.
  }
  setTimeout(function () {
    for(i = 0; i < pages.length; i++){
      document.getElementById(pages[i]).style.display = "none";
    }
  },1000); // After they all have stopped animating stop displaying those aforementioned pages.
  page.display = "block"; // Display the page we ae switching too.
  page.animationName = "fadeIn"; // Animate it to smoothen the switch.
}

function displayPU(id){ // Displays a pop up to the user.
  document.getElementById(id).style.display = "block";
}
