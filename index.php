<html>
  <?php
    #error_reporting(0); # Turn off error reporting.
    $db = mysqli_connect("localhost", "root", "", "hmi"); # Connect to the MySQL database. All queries use this conenction to communicate to the database.
    $admin = FALSE; # Default this variable to be false for when the user is not signed in.
    if(isset($_COOKIE["user"])){ # If the user has signed in.
      $uid = $_COOKIE["user"]; # Extract the ID data from the cookie and store it as a variable.
      $userRow = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM users WHERE uid=".$uid)); # Select all data associated witht his particular user and store it as an array.
      if($userRow[7] == "1"){ # This fetches the user level. If it is set to a value of one the the user must be an admin.
        $admin = TRUE;
      }
      global $uid, $userRow;
    }
    else { # If the user is not signed in we should change the UI so that the user knows that they cannot enter the forum or tool pages.
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
    <!-- The above imports all of the css resources neccessary for the page. The first two links link to external resources, the first to retrive the fonts used and the second t retrive the icons packs that is needed for the UI. -->
    <?php
      if(isset($_COOKIE["accessedBefore"])){ # Disables the first-load entry screen before init() is triggered so that it does not display.
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
    <!-- Above are all of the JavaScript scripts neccessary for the site to function. -->
    <div id="dayChangeBtn" onclick="dayChangeClick();"><i class="material-icons">brightness_3</i></div> <!-- The button that switches between day and night mode. -->
    <div id="enterBtnCon"><h1 id="enterBtn" class="coloredText redPurple">A</h1></div> <!-- First-load button to enter the website. -->
    <div id="bgObjCon"> <!-- Contains all of the elements that make up the 3D-like effect of the first-load page. -->
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
      <div id="menuCon"> <!-- Contains all of the links to different "pages" within the site. menuBtnClick() is defined in js/entryScript.php -->
        <p onclick="menuBtnClick('account');"><i class="material-icons">person</i></p>
        <hr class="menuRule">
        <?php if(isset($_COOKIE["user"])){echo('<p onclick="menuBtnClick(\'search\');"><i class="material-icons">search</i></p>');}?>
        <p onclick="menuBtnClick('home');"><i class="material-icons">home</i></p>
        <p onclick="menuBtnClick('tool');"><i id="toolBtn" class="material-icons" onclick="menuBtnClick('tool');">build</i></p>
        <p onclick="menuBtnClick('news');"><i class="material-icons">announcement</i></p>
        <p onclick="menuBtnClick('about');"><i class="material-icons">help</i></p>
        <p onclick="menuBtnClick('forum');"><i id="forumBtn" class="material-icons">subject</i></p>
        <hr class="menuRule postBtn">
        <p id="forumPostMenuBtn" class="postBtn" onclick="displayPU('postingPU');"><i class="material-icons">create</i></p> <!-- This will only display when the forumPage or forumSinglePage is being viewed -->
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
          <p class="subTitle"><?php isset($_GET["disease"]) ? $t = "Disease" : $t = "Sequence"; echo ($t); #This prints out a title $t depending on whether or not `disease` is set in the url. If so we can print out the name of the disease. Otherwise we use a generic , descriptive title. ?></p>
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
      <div id="forumPage" class="page"> <!-- For viewing links to different threads and posting a new thread. -->
        <div class="textCon">
          <p class="subTitle">Forum</p>
            <div id="forumPageContent">
            </div>
          </div>
        </div>
        <div id="forumSingleViewPage" class="page"> <!-- For viewing one particular thread and posting messeges and replies to messages to that thread. -->
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
        $trim = array_map('trim', $_POST); # Each data in the $_POST superglobal array (submiited via POST) has excess spaces removed to lower the amount of storage used by the database.
        $popupTop = '<div class="boardConPU"><div class="popUpBox redPurple"><div class="textConPU"><p class="titlePU">Notification<span class="crossPU">X</span></p>';
        $altPopupTop = substr($popupTop, 0, 23).' style="display: none" id="postingPU">'.substr($popupTop, 24); # For forum POST forms.
        $popupBottom = '</div></div></div>';
        # Loads the PHP scripts that are neccessary for website function.
        # Require_once makes sure that only one version of the file is included and prevents the execution of the rest of this script if it is not present - preventing a user from running an errornous version of this program.
        require_once("php/toolFunctions.php");
        require_once("php/dictionary.php");
        require_once("php/hashing32.php");
        require_once("php/queue.php");
        require_once("php/onload/onloadLOAD.php");
        require_once("php/submission/submissionLOAD.php");
        # Tags that need to be loaded on start but require PHP to display the correct information.
        if(isset($_COOKIE["user"])){ # If signed into an account.
          if(isset($_GET["thread"])){ # If we are displaying the forumSingleViewPage we must have a thread variable in the query string of the URL in order to view a single thread. If so the forms for posting will be different to that of the forumPage.
              echo($altPopupTop.'<br>Reply To The Original Post<br><br><form action="index.php?page=forum&thread='.$_GET["thread"].'" method="post"><textarea name="messagePM" class="textareaPU PUInput" info="Message" onfocus="clearValue(this); selected(this);" onblur="restoreValue(this); deselected(this);">Message</textarea><br><br><input name="submittedPM" type="submit" class="button btnPU PUInput"/></form>'.$popupBottom);
              # The above line create a form that is used for posting messages to the original post. Submittted via POST.
              echo(substr($popupTop, 0, 23).'style="display: none" id="replyingPU">'.substr($popupTop, 24).'<br>Reply To A Message<br><br><form action="index.php?page=forum&thread='.$_GET["thread"].'" method="post"><textarea name="messagePR" class="textareaPU PUInput" info="Message" onfocus="clearValue(this); selected(this);" onblur="restoreValue(this); deselected(this);">Message</textarea><br><br><input id="midPR" name="midPR" type="hidden" value=\'\'/><input name="submittedPR" type="submit" class="button btnPU PUInput"/></form>'.$popupBottom); # Take the first part of the popup and then concatenate HTML makes up a form for posting replies to messages.  Submittted via POST.
          }
          else { # If not displaying the forumSingleView (therefore no thread be displyed).
              $s = isset($trim["subjectPT"]) ? $trim["subjectPT"] : "Subject"; # If the thread post was tried and failed, retain the data so that it can be corrected and resubmitted.
              $m = isset($trim["messagePT"]) ? $trim["messagePT"] : "Message"; # ^ Else print the default value.
              echo($altPopupTop.'<br>Start A Thread<br><br><form action="index.php?page=forum" method="post"><textarea class="textareaPU subjectTextareaPU PUInput" name="subjectPT" info="Subject" onfocus="clearValue(this); selected(this);" onblur="restoreValue(this); deselected(this);">'.$s.'</textarea><br><br><textarea name="messagePT" class="textareaPU PUInput" info="Message" onfocus="clearValue(this); selected(this);" onblur="restoreValue(this); deselected(this);">'.$m.'</textarea><br><br><input name="submittedPT" type="submit" class="button btnPU large"/></form>'.$popupBottom);
              # The above line of code prints out a form for posting a thread. Submittted via POST.
          }
        }
      ?>
      </div>
   </body>
</html>
