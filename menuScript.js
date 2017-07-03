function menuBtnClick(value) {
  page = document.getElementById(value+"Page").style;
  list = ["homePage", "toolPage", "newsPage", "aboutPage", "forumPage"];
  if (value !== "options"){
    index = list.indexOf(value+"Page");
    list.splice(index, 1);
    for(i = 0; i < list.Length; i++) {
      pageII = document.getElementById(list[i]).style.animationDirection = "reverse";
    }
    page.animationName = "fadeIn";
    page.animationDirection = "normal";
    page.animationIterationCount = String(Number(page.animationIterationCount)+1);
  }
  else {
    if (page.animationName === "fadeIn" && page.animationDirection === "normal"){
      page.animationDirection = "reverse";
    }
    else {
      page.animationName = "fadeIn";
      page.animationDirection = "normal";
      page.animationIterationCount = String(Number(page.animationIterationCount)+1);
    }
  }
}
