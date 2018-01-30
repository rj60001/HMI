function menuBtnClick(value) { /*Used to switch between pages.*/
  document.getElementById("homePage").style.opacity = '0';
  values = document.getElementsByClassName("postBtn");
  if((value === "forum" || value === "forumSingleView") && document.cookie.substring(document.cookie.indexOf("user"), document.cookie.indexOf("user")+4) === "user"){
    for(i=0;i < values.length; i++){
      values[i].style.display = "block";
    }
  }
  else {
    for(i=0;i < values.length; i++){
      values[i].style.display = "none";
    }
  }

  if(value === "forum" && window.location.href.indexOf("thread") != -1){
    window.location.href = "index.php?page=forum";
  }
  if((value === "forum" || value === "tool") && document.cookie.substring(document.cookie.indexOf("user"), document.cookie.indexOf("user")+4) !== "user"){
    return 0;
  }
  value += "Page"
  page = document.getElementById(value).style;
  pages = ["homePage", "accountPage", "toolPage", "newsPage", "aboutPage", "forumPage", "forumSingleViewPage", "toolSingleViewPage", "searchPage"];
  pages.splice(pages.indexOf(value), 1);
  for(i = 0; i < pages.length; i++){
    document.getElementById(pages[i]).style.animationName = "fadeOut";
  }
  setTimeout(function () {
    for(i = 0; i < pages.length; i++){
      document.getElementById(pages[i]).style.display = "none";
    }
  },1000);
  page.display = "block";
  page.animationName = "fadeIn";
}

function displayPU(id){
  document.getElementById(id).style.display = "block";
}
