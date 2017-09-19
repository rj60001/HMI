<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Nomios</title>
    <link href="https://fonts.googleapis.com/css?family=Comfortaa|Megrim" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/menuStyles.css">
    <link rel="stylesheet" href="css/inputStyles.css">
    <link rel="stylesheet" href="css/mediaStyles.css">
  </head>
  <body>
    Version 0.1
    <script src="https://www.w3schools.com/lib/w3.js"></script>
    <script src="js/entryScript.js"></script>
    <script src="js/menuScript.js"></script>
    <script src="js/inputScript.js"></script>
    <!-- Above are all relevant scripts -->
    <div id="dayChangeBtn" info="day" onclick="dayChangeClick();"><i class="material-icons">brightness_3</i></div>
    <div id="enterBtnCon"><h1 id="enterBtn">A</h1></div>
    <div id="bgObjCon">
      <div name="bgObj" class="bgObjBig" style="position: absolute; top: 69%; left: 10%; animation-fill-mode: backwards;">A</div>
      <div name="bgObj" class="bgObjBig" style="position: absolute; top: 11%; left: 34%;">A</div>
      <div name="bgObj" class="bgObjBig" style="position: absolute; top: 43%; left: 62%; animation-name: floatTwo;">A</div>
      <div name="bgObj" class="bgObjBig" style="position: absolute; top: 55%; left: 28%; animation-fill-mode: backwards;">G</div>
      <div name="bgObj" class="bgObjMed" style="position: absolute; top: 29%; left: 44%; animation-name: floatTwo;">G</div>
      <div name="bgObj" class="bgObjMed" style="position: absolute; top: 11%; left: 22%; animation-name: floatTwo; animation-fill-mode: backwards;">G</div>
      <div name="bgObj" class="bgObjMed" style="position: absolute; top: 66%; left: 37%; animation-name: floatTwo;">T</div>
      <div name="bgObj" class="bgObjMed" style="position: absolute; top: 77%; left: 59%; animation-name: floatThree;">T</div>
      <div name="bgObj" class="bgObjMed" style="position: absolute; top: 58%; left: 23%; animation-name: floatFour; animation-fill-mode: backwards;">T</div>
      <div name="bgObj" class="bgObjSmall" style="position: absolute; top: 82%; left: 68%; animation-name: floatFour;">T</div>
      <div name="bgObj" class="bgObjSmall" style="position: absolute; top: 68%; left: 28%; animation-name: floatThree;">A</div>
      <div name="bgObj" class="bgObjSmall" style="position: absolute; top: 27%; left: 38%; animation-name: floatFour; animation-fill-mode: backwards;">A</div>
      <div name="bgObj" class="bgObjSmall" style="position: absolute; top: 60%; left: 67%; animation-name: floatThree;">A</div>
      <div name="bgObj" class="bgObjSmall" style="position: absolute; top: 89%; left: 60%; animation-name: floatFour;">T</div>
      <div name="bgObj" class="bgObjSmall" style="position: absolute; top: 75%; left: 57%; animation-name: floatThree; animation-fill-mode: backwards;">A</div>
      <div name="bgObj" class="bgObjBig" style="position: absolute; top: 12%; left: 70%; animation-name: floatTwo;">T</div>
      <div name="bgObj" class="bgObjBig" style="position: absolute; top: 38%; left: 80%;  animation-name: floatFour;">A</div>
      <div name="bgObj" class="bgObjMed" style="position: absolute; top: 11%; left: 76%; animation-name: floatTwo; animation-fill-mode: backwards;">C</div>
      <div name="bgObj" class="bgObjMed" style="position: absolute; top: 16%; left: 85%;">T</div>
      <div name="bgObj" class="bgObjSmall" style="position: absolute; top: 80%; left: 78%; animation-name: floatThree; animation-fill-mode: backwards;">C</div>
      <div name="bgObj" class="bgObjSmall" style="position: absolute; top: 40%; left: 10%; animation-name: floatThree; animation-fill-mode: backwards;">C</div>
    </div>
    <div id="mainCon">
      <div id="menuCon">
        <p onclick="menuBtnClick('account');"><i class="material-icons">person</i></p>
        <hr class="menuRule">
        <p onclick="menuBtnClick('home');"><i class="material-icons">home</i></p>
        <p onclick="menuBtnClick('tool');"><i class="material-icons" onclick="menuBtnClick('tool');">build</i></p>
        <p onclick="menuBtnClick('news');"><i class="material-icons">announcement</i></p>
        <p onclick="menuBtnClick('about');"><i class="material-icons">help</i></p>
        <p onclick="menuBtnClick('forum');"><i class="material-icons">subject</i></p>
      </div>
      <div id="homePage" class="page">
        <p name="title" class="title">Nomios</p>
        <div class="textCon">
          <p name="subTitle" class="subTitle">WELCOME</p>
          <p name="text" class="text">Lorem ipsum dolor sit amet, an vim partem graeco aeterno, affert liberavisse intellegebat ad quo, usu oblique omnesque constituto cu. No mei unum ignota noster. Mel esse delenit in. Viris dignissim in vis. Sed agam delicata consequat ne, elit dicit cum in.Ius vero deserunt no. Ne amet erant qui, autem explicari eam ex. Ponderum intellegebat cum id. Nec aliquip repudiare at.In mundi tractatos adipiscing ius, alia neglegentur qui id. Ferri aliquando interesset has et, et vix numquam mediocritatem. Eum eu porro inani. Vel ne dicunt pertinacia. Suas quas efficiendi pri cu.Ne mel lucilius moderatius, has oratio veniam persius ut. Utroque nominavi splendide nec ei. Ex pro idque legere mediocrem, ex qui homero splendide. Ne est definiebas consequuntur, duo ex saepe ullamcorper. Mea ne nibh labitur definitionem.
          Sit no wisi mundi vulputate, no debet ullamcorper sea. An liber atomorum pertinacia ius, quando petentium et usu, cu sea erant civibus accumsan. His quod veri cetero ut, sit in possim minimum. Iuvaret dolorem philosophia sit ei.<p>
        </div>
      </div>
      <div id="toolPage" class="page">
        <p name="title" class="title">Nomios</p>
        <div class="textCon">
          <p name="subTitle" class="subTitle">TOOL</p>
          <p class="text">This is the main tool page. Here you can add or pull data from the database on any DNA sequence, by completing the form that follows:</p>
          <br>
          <fieldset>
            <legend> DNA Sequence </legend>
            <textarea id="dnaSeqence" onkeypress="dnaInputCheck(this);"></textarea>
          </fieldset>
          </p>
        </div>
      </div>
      <div id="newsPage" class="page">
        <p name="title" class="tindexitle">Nomios</p>
        <div class="textCon">
          <p name="subTitle" class="subTitle"></p>
          <p class="text"></p>
        </div>
      </div>
      <div id="aboutPage" class="page">
        <p name="title" class="title">Nomios</p>
        <div class="textCon">
          <p name="subTitle" class="subTitle"></p>
          <p class="text"></p>
        </div>
      </div>
      <div id="forumPage" class="page">
        <p name="title" class="title">Nomios</p>
        <div class="textCon">
          <p name="subTitle" class="subTitle"></p>
          <p class="text"></p>
        </div>
      </div>
      <div id="accountPage" class="page">
        <p name="title" class="title">Nomios</p>
        <div class="textCon">
          <p name="subTitle" class="subTitle">ACCOUNT</p>
          <div>
            <br>
            <fieldset class="doubleForm">
              <div class="con">
                <form action="index.php?page=account" method="post"></form>
                  <input id="firstNameSU" type="text" value="Rosalind" info="Rosalind" onfocus="clearValue(this);" onblur="restoreValue(this);"/>
                  <input id="secondNameSU" type="text" value="Franklin" info="Franklin" onfocus="clearValue(this);" onblur="restoreValue(this);"/>
                  <input id="emailAddressSU" type="email" value="fr@example.com" info="fr@example.com" onfocus="clearValue(this);" onblur="restoreValue(this);"/>
                  <input id="passwordSU" type="password" value="Password" info="Password" onfocus="clearValue(this);" onblur="restoreValue(this); checkPassword(this);"/>
                  <input id="passwordConSU" type="password" value="Password" info="Password" onfocus="clearValue(this);" onblur="restoreValue(this); checkPassword(this);"/>
                  <select id="interestSU">
                    <option value="NULL">Interest</option>
                    <option value="Scientist">For science!</option>
                    <option value="Company">For a company</option>
                    <option value="Student">I'm a student :)</option>
                    <option value="Curious">Just curious</option>
                  </select>
                  <input type="submit" value="Sign up" class="button"/>
                  <input name="submittedSU" type="hidden" value="TRUE"/>
                </form>
                </div>
                </fieldset>
                <fieldset class="doubleForm">
                  <div class="con">
                    <form action="index.php?page=account" method="post">
                      <input id="emailAddressSI" type="email" value="fr@example.com" info="fr@example.com" onfocus="clearValue(this);" onblur="restoreValue(this);"/>
                      <input id="passwordSI" type="password" value="Password" info="Password" onfocus="clearValue(this);" onblur="restoreValue(this);"/>
                      <input type="submit" value="Sign up" class="button"/>
                      <input name="submittedSI" type="hidden" value="TRUE"/>
                    </form>
                  </div>
                </fieldset>
             </div>
          </div>
        </div>
      </div>
   </body>
</html>
