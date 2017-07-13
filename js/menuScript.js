function menuBtnClick(value) {
  document.getElementById("homePage").style.opacity = '0';
  value += "Page"
  page = document.getElementById(value).style;
  pages = ["homePage", "accountPage", "toolPage", "newsPage", "aboutPage", "forumPage"];
  pages.splice(pages.indexOf(value), 1);
  for(i = 0; i < (pages.length); i++){
    document.getElementById(pages[i]).style.animationName = "fadeOut";
  }
  setTimeout(function () {
    for(i = 0; i < (pages.length); i++){
      document.getElementById(pages[i]).style.display = "none";
    }
  },1000);
  page.display = "block";
  page.animationName = "fadeIn";
}
