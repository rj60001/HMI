function moveScrollPosition(pos) { /*Scroll the document*/
  document.body.scrollTop = 1000;
}

function loadUserData(name, ea, admin){
  d = new Date();
  document.getElementById("accountPageContent").innerHTML = '<form id="accountDetailsForm" action="index.php?page=account" method="post" class="greenYellow floatAesthetic"><p class="info">'+name+'</p><p class="info">'+ea+'</p>'+admin+'<input name="passwordAE" type="password" value="Password" info="Password" onfocus="clearValue(this); selected(this);" onblur="restoreValue(this); deselected(this);"/><input name="passwordConAE" type="password" value="Password" info="Password" onfocus="clearValue(this); selected(this);" onblur="restoreValue(this); deselected(this);"/><input name="submitAE" type="submit" value="Submit"/><input name="submittedAE" type="hidden" value="TRUE"></type><br><div id="signOutBtn" class="button redBtn large" onclick="document.cookie = \'user=;expires=Thu, 01 Jan 1970 00:00:00 UTC\'; window.location.href=\'http://www.google.co.uk\';"><p>Sign out</p></div>';
}

function loadAccountPage(){
  document.getElementById("accountPageContent").innerHTML = '<br><div id="con"><div id="signUpForm" class="redPurple floatAesthetic"><form action="index.php?page=account" method="post"><br><br><input name="firstNameSU" type="text" value="Rosalind" info="Rosalind" onfocus="clearValue(this); selected(this);" onblur="restoreValue(this); deselected(this);"/><input name="secondNameSU" type="text" value="Franklin" info="Franklin" onfocus="clearValue(this); selected(this);" onblur="restoreValue(this); deselected(this);"/><input name="emailAddressSU" type="email" value="rf@example.com" info="rf@example.com" onfocus="clearValue(this); selected(this);" onblur="restoreValue(this); deselected(this);"/><input id="passwordConSU" name="passwordConSU" type="password" value="Password" info="Password" onfocus="clearValue(this); selected(this);" onblur="restoreValue(this); deselected(this);"/><select name="interestSU"><option value="NULL">Interest</option><option value="Scientist">For science!</option><option value="Company">For a company</option><option value="Student">I\'m a student :)</option><option value="Curious">Just curious</option></select><input type="submit" value="Sign up" class="button"/><input name="submittedSU" type="hidden" value="TRUE"/></form></div><div id="signInForm" class="greenYellow floatAesthetic"><form action="./index.php?page=account" method="post"><br><input name="emailAddressSI" type="email" value="rf@example.com" info="rf@example.com" onfocus="clearValue(this); selected(this);" onblur="restoreValue(this); deselected(this);"/><input name="passwordSI" type="password" value="Password" info="Password" onfocus="clearValue(this); selected(this);" onblur="restoreValue(this); deselected(this);"/><input type="submit" value="Sign in" class="button"/><input name="submittedSI" type="hidden" value="TRUE"/></form></div></div>';
}
