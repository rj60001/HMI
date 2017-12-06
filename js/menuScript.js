function menuBtnClick(value) {
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
  pages = ["homePage", "accountPage", "toolPage", "newsPage", "aboutPage", "forumPage", "forumSingleViewPage", "toolSingleViewPage", "searchViewPage"];
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

function loadUserData(name, ea, admin){
  d = new Date();
  document.getElementById("accountPageContent").innerHTML = '<br><fieldset><br><br><form action="index.php?page=account" method="post"><p class="info">'+name+'</p><p class="info">'+ea+'</p>'+admin+'<input name="passwordAE" type="password" value="Password" info="Password" onfocus="clearValue(this);" onblur="restoreValue(this); checkPassword(this);"/><input name="passwordConAE" type="password" value="Password" info="Password" onfocus="clearValue(this);" onblur="restoreValue(this); checkPassword(this);"/><input name="submitAE" type="submit" value="Submit"/><input name="submittedAE" type="hidden" value="TRUE"></type></fieldset><br><div id="signOutBtn" class="button red large" onclick="document.cookie = \'user=;expires=Thu, 01 Jan 1970 00:00:00 UTC\'; window.location.href=\'http://www.google.co.uk\';"><p>Sign out</p></div>';
}

function loadAccountPage(){
  document.getElementById("accountPageContent").innerHTML = '<br><fieldset class="doubleForm"><div class="con"><form action="./index.php?page=account" method="post"><input name="firstNameSU" type="text" value="Rosalind" info="Rosalind" onfocus="clearValue(this);" onblur="restoreValue(this);"/><input name="secondNameSU" type="text" value="Franklin" info="Franklin" onfocus="clearValue(this);" onblur="restoreValue(this);"/><input name="emailAddressSU" type="email" value="rf@example.com" info="rf@example.com" onfocus="clearValue(this);" onblur="restoreValue(this);"/><input id="passwordConSU" name="passwordConSU" type="password" value="Password" info="Password" onfocus="clearValue(this);" onblur="restoreValue(this);"/><select name="interestSU"><option value="NULL">Interest</option><option value="Scientist">For science!</option><option value="Company">For a company</option><option value="Student">I\'m a student :)</option><option value="Curious">Just curious</option></select><input type="submit" value="Sign up" class="button"/><input name="submittedSU" type="hidden" value="TRUE"/></form></div></fieldset><fieldset class="doubleForm"><div class="con"><form action="./index.php?page=account" method="post"><input name="emailAddressSI" type="email" value="rf@example.com" info="rf@example.com" onfocus="clearValue(this);" onblur="restoreValue(this);"/><input name="passwordSI" type="password" value="Password" info="Password" onfocus="clearValue(this);" onblur="restoreValue(this);"/><input type="submit" value="Sign in" class="button"/><input name="submittedSI" type="hidden" value="TRUE"/></form></div></fieldset>';
}

function displayPU(id){
  document.getElementById(id).style.display = "block";
}
