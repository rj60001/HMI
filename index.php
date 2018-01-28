<html>
  <?php
    #error_reporting(0); # Turn off error reporting.
    $db = mysqli_connect("localhost", "root", "", "hmi");
    $uid = "";
    $userRow = [];
    $admin = FALSE;
    if(isset($_COOKIE["user"])){
      $uid = $_COOKIE["user"];
      $userRow = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM users WHERE uid=".$uid));
      if(mysqli_fetch_array(mysqli_query($db, "SELECT level FROM users WHERE uid=".$uid))[0] == "1"){
        $admin = TRUE;
      }
    }
    else {
      echo('<style>#forumBtn, #toolBtn {
        cursor: not-allowed;
      }</style>');
    }
  ?>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Nomios</title>
    <link href="https://fonts.googleapis.com/css?family=Megrim|Comfortaa" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="css/animations.css">
    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/inputStyles.css">
    <link rel="stylesheet" href="css/mediaQueries.css">
    <link rel="stylesheet" href="css/pages.css">
    <link rel="stylesheet" href="css/accountStyles.css">
    <link rel="stylesheet" href="css/popupStyles.css">
    <link rel="stylesheet" href="css/forumStyles.css">
    <link rel="stylesheet" href="css/toolStyles.css">
    <link rel="stylesheet" href="css/homeStyles.css">
    <link rel="stylesheet" href="css/entryStyles.css">
    <link rel="stylesheet" href="css/searchStyles.css">
    <?php
      if(isset($_COOKIE["accessedBefore"])){ //Disables the entry screen before init() is triggered so that it does not display.
        echo('<style> #bgObjCon, #enterBtnCon {
          display: none;
        }
        #mainCon {
          animation-duration: 1s;
        }</style>');
      }
    ?>
  </head>
  <body>
    <script src="https://www.w3schools.com/lib/w3.js"></script>
    <script src="js/entryScript.js"></script>
    <script src="js/menuScript.js"></script>
    <script src="js/inputScript.js"></script>
    <script src="js/toolScript.js"></script>
    <script src="js/accountScript.js"></script>
    <!-- Above are all relevant scripts -->
    <div id="dayChangeBtn" onclick="dayChangeClick();"><i class="material-icons">brightness_3</i></div>
    <div id="enterBtnCon"><h1 id="enterBtn" class="coloredText redPurple">A</h1></div>
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
        <?php if(isset($_COOKIE["user"])){echo('<p onclick="menuBtnClick(\'search\');"><i class="material-icons">search</i></p>');}?>
        <p onclick="menuBtnClick('home');"><i class="material-icons">home</i></p>
        <p onclick="menuBtnClick('tool');"><i id="toolBtn" class="material-icons" onclick="menuBtnClick('tool');">build</i></p>
        <p onclick="menuBtnClick('news');"><i class="material-icons">announcement</i></p>
        <p onclick="menuBtnClick('about');"><i class="material-icons">help</i></p>
        <p onclick="menuBtnClick('forum');"><i id="forumBtn" class="material-icons">subject</i></p>
        <hr class="menuRule postBtn">
        <p id="forumPostMenuBtn" class="postBtn" onclick="displayPU('postingPU');"><i class="material-icons">create</i></p>
      </div>
      <div id="searchPage" class="page">
        <div id="searchFormCon">
        </div>
        <div id="searchResultsCon" class="textCon"> <!-- This is where the results show up from a search. -->
        </div>
      </div>
      <div id="homePage" class="page">
        <p id="homeTitle" class="coloredText redPurple">Nomios</p>
        <br>
        <p id="homeSubTitle">A tool for histone modifications, a forum for scientists.</p>
        <div class="textCon">
        </div>
      </div>
      <div id="toolPage" class="page">
        <div id="toolPageContent" class="textCon">
        </div>
      </div>
      <div id="toolSingleViewPage" class="page">
        <div class="textCon">
          <p class="subTitle"><?php isset($_GET["disease"]) ? $t = "Disease" : $t = "Sequence"; echo ($t); #This prints out a title $t depending on whether or not `disease` is set in the url ?></p>
          <div id="toolSingleViewPageContent">
            <br><br>
          </div>
        </div>
      </div>
      <div id="newsPage" class="page">
        <div class="textCon">
          <p class="subTitle">News</p>
          <p class="text"></p>
          <br><br>
        </div>
      </div>
      <div id="aboutPage" class="page">
        <div class="textCon">
          <p class="subTitle">About</p>
          <p class="text"></p>
          <br><br>
        </div>
      </div>
      <div id="forumPage" class="page">
        <div class="textCon">
          <p class="subTitle">Forum</p>
            <div id="forumPageContent">
            </div>
          </div>
        </div>
        <div id="forumSingleViewPage" class="page">
        <div class="textCon">
          <p class="subTitle">Forum</p>
          <div id="forumSingleViewPageContent">
            </div>
          </div>
        </div>
        <div id="accountPage" class="page">
          <div class="textCon">
            <p class="subTitle" id="accountSubTitleStrip">Account</p>
            <div id="accountPageContent">
            </div>
          </div>
        </div>
      </div>
      <?php
         $trim = array_map('trim', $_POST); # All submitted data is trimmed down to the fewest possible charcaters.
        $popupTop = '<div class="boardConPU"><div class="popUpBox redPurple"><div class="textConPU"><p class="titlePU">Notification<span class="crossPU">X</span></p>';
        $altPopupTop = substr($popupTop, 0, 23).' style="display: none" id="postingPU">'.substr($popupTop, 24); # For forum posts.
        $popupBottom = '</div></div></div>';
        require("php/toolFunctions.php");
        require_once("php/onload/onloadLOAD.php");
        require_once("php/submission/submissionLOAD.php");
        #Tags that need to be loaded on start but require PHP.
        if(isset($_COOKIE["user"])){
          if(isset($_GET["thread"])){
              echo($altPopupTop.'<br>Post A Reply<br><br><form action="index.php?page=forum&thread='.$_GET["thread"].'" method="post"><textarea name="messagePM" class="textareaPU PUInput" info="Message" onfocus="clearValue(this); selected(this);" onblur="restoreValue(this); deselected(this);">Message</textarea><br><br><input name="submittedPM" type="submit" class="button btnPU PUInput"/></form>'.$popupBottom);
              echo(substr($popupTop, 0, 23).'style="display: none" id="replyingPU">'.substr($popupTop, 24).'<br>Reply To A Message<br><br><form action="index.php?page=forum&thread='.$_GET["thread"].'" method="post"><textarea name="messagePR" class="textareaPU PUInput" info="Message" onfocus="clearValue(this); selected(this);" onblur="restoreValue(this); deselected(this);">Message</textarea><br><br><input id="midPR" name="midPR" type="hidden" value=\'\'/><input name="submittedPR" type="submit" class="button btnPU PUInput"/></form>'.$popupBottom);
          }
          else {
              $s = isset($trim["subjectPT"]) ? $trim["subjectPT"] : "Subject";
              $m = isset($trim["messagePT"]) ? $trim["messagePT"] : "Message";
              echo($altPopupTop.'<br>Start A Thread<br><br><form action="index.php?page=forum" method="post"><textarea class="textareaPU subjectTextareaPU PUInput" name="subjectPT" info="Subject" onfocus="clearValue(this); selected(this);" onblur="restoreValue(this); deselected(this);">'.$s.'</textarea><br><br><textarea name="messagePT" class="textareaPU PUInput" info="Message" onfocus="clearValue(this); selected(this);" onblur="restoreValue(this); deselected(this);">'.$m.'</textarea><br><br><input name="submittedPT" type="submit" class="button btnPU large"/></form>'.$popupBottom);
          }
        }
      ?>
      </div>
   </body>
</html>
