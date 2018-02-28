# Nomios -Technical Solution

This document contains the code that makes up my solution. The code is explained using the comments that are within the code for each file. Please remember that each reference to "page" is to a HTML element that takes up most of the screen and contains a specific category of information. It is not a webpage!

For a more clear read of the code, the files themselves should be opened.

My solution can be split into different pages:

* The **account page** is the page for dealing with user accounts.
* The **forum page** is the page for viewing all threads or creating a new one
* The **forum single view page** is the page for viewing a single thread.
* The **tool page** is the page for creating a new disease or nucleosome sequence.
* The **tool single view page** is the page for viewing a single nucleosome sequence or a single disease.
* The **search page** is the page for searching threads, diseases or nucleosome sequences. The results can be further filtered to those created by the user or to all records.
* The **about page** is where an explanation of what the website is about and the help guide are located.
* The **entry page** is the landing page for new users.
* The **home page** is where the user is directed to after they pass the **onload page**.

The project has been modularized into different files depending on the page their code is relating to and when that code is executed. This makes maintenace iof the code easier, as it is less complicated to read. 

## index.php

This is the webpage that the user accesses. All other resources are loaded onto this page, potentially changing it to suit the circumstances of the user. This is necessary because my website uses a single web page as explain in my *Analysis*.

```php
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
          <div class="strip redPurple">
            <br>
            <p class="text">No news!</p>
          </div>
          <br><br>
        </div>
      </div>
      <div id="aboutPage" class="page">
        <div class="textCon">
          <p class="subTitle">About</p>
          <br>
          <div class="strip redPurple"<p class="text"><b>Nomios</b> is a single platform for two services: </p><ulclass="text"><li>A forum for scientists. No matter what specialists field you are in, you can meet others, collaborate and learn on a single platform.</li><li>A histone modification interpreter for epigeneticists. Simulate your experiments and save time and resources. Find what the overall change in expression is for a particular histone modification sequence.</li></ul><p class="text">Founded in 2018, this platform was designed to encorage global research and quick access to knowledge concerning any questions that a scientist today might have.</p></div>
          <br>
          <p class="subTitle">help</p>
          <br>
          <div class="strip greenYellow">The following contains a simple guide for use of the <b>forum</b>: <ul><li>In order to enter the forum first click on the <i class="material-icons">subject</i> icon.<li>To start a new thread click on the <i class="material-icons">create</i> icon.</li><li>To view a thread click on one of the thread items that are displayed.</li><li>Once viewing a thread click on the <i class="material-icons">create</i> icon to reply to the original post, or click on a response to reply to it.</li><li>Mark-up is supported. <b>[b][/b]</b> emboldens text. <em>[i][/i]</em> creates italics. [l][/l] specifies a list, with [li][/li] being the items on this list. Mark-up can only be used in the <em>Message</em> components of a post.</li></ul></div>
          <br>
          <div class="strip orangeBlue">The following contains a simple guide for use of the <b>histone modfication interpreter</b>:<ul><li>Click the <i class="material-icons">build</i> icon to create a disease or nucleosome sequence.</li><li>Click the <i class="material-icons">search</i> icon to search for a particular nucleosome sequence or disease.</li><li>On a Disease page, click the nucleosome sequence block to view that sequence.</li><li>On a Sequence page, click the disease block to view the associated disease's page.</li><li>Submit the edit forms on both types of page to confirm edits to a sequence or disease that you have created.</li></ul></div>
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
        $trim = array_map(array($db, 'real_escape_string'), $trim); # Each data submitted via POST now escapes any problematic characters, sucha as quotiation marks that could distort queries in the from of strings.
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
              $subject = isset($trim["subjectPT"]) ? $trim["subjectPT"] : "Subject"; # If the thread post was tried and failed, retain the data so that it can be corrected and resubmitted.
              $message = isset($trim["messagePT"]) ? $trim["messagePT"] : "Message"; # ^ Else print the default value.
              echo($altPopupTop.'<br>Start A Thread<br><br><form action="index.php?page=forum" method="post"><textarea class="textareaPU subjectTextareaPU PUInput" name="subjectPT" info="Subject" onfocus="clearValue(this); selected(this);" onblur="restoreValue(this); deselected(this);">'.$subject.'</textarea><br><br><textarea name="messagePT" class="textareaPU PUInput" info="Message" onfocus="clearValue(this); selected(this);" onblur="restoreValue(this); deselected(this);">'.$message.'</textarea><br><br><input name="submittedPT" type="submit" class="button btnPU large"/></form>'.$popupBottom);
              # The above line of code prints out a form for posting a thread. Submittted via POST.
          }
        }
      ?>
      </div>
   </body>
</html>
```

##css/accountStyles.css

This contain the CSS code that stylises the account page.

```css
/*IDs*/
  #signInForm, #signUpForm {
    min-width: 49%;
    max-width: 49%;
    height: auto;
    max-height: none;
    float: left;  /* This aligns the element either to the left or right. */
    border-radius: 3px; /* This rounds the corners of elements. */
    border-style: none; /* Changes the style-type of the border to be not exist. */
  }

  #signInForm > form, #signUpForm > form { /* The forms within the #signUpForm and #signInForm elements. */
    margin: 5%; /* Adds space to the outside of the element to adjust the element itself. */
  }

  #signInForm {
    float: right;
    vertical-align: top; /* Sets the element to be inline with the top of its adjacent element. */
  }

  #con { /*Is a container for the sigg in and sign up forms.*/
    min-width: 100%;
    max-width: 100%;
    min-height: 100%;
    max-height: 100%;
  }

  #downButton {
    display: block;
    margin-right: auto; /* Automatically sets both left and right margins of the element to be equal. */
    margin-left: auto; /* ^ */
    cursor: pointer; /* Changes the texture of the cursor. */
  }

  #accountDetailsForm {
    border-radius: 3px;
    border-style: none; /* Border is reduced to minium thickness */
    padding: 5%; /* Adjusts space inside an element to move elements inside the element. */
  }
```

## css/animations.css

This contains the CSS animations that are used in other CSS files.

```css
/* On first load */
  @keyframes bounce {
    50% {transform: translateY(-5%);}
    100% {transform: translateY(5%);}
  }

  @keyframes flyAway {
    100% {transform: translateY(2000px);}
  }

  @keyframes floatOne {
    50% {transform: translate(10%, 10%);}
  }

  @keyframes floatTwo {
    50% {transform: translate(-10%, -10%);}
  }

  @keyframes floatThree {
    50% {transform: translate(-10%, 10%);}
  }

  @keyframes floatFour {
    50% {transform: translate(10%, -10%);}
  }

  /*For page switching*/
  @keyframes fadeIn {
      100% {opacity: 1;}  /* 'opacity' sets how opaque the element is. */
  }
  @keyframes fadeOut {
      100% {opacity: 0;}
  }
```

## css/entryStyles.css

This is the CSS code that stylises the landing page (this is a page for a first-time user).

```css
/*IDs*/
  #enterBtn {
    display: block;
    cursor: pointer;
    transition-timing-function: ease-in-out; /* Specifies the speed curve. Slow start, quick end. */
    position: relative;
    z-index: 2; /* Specifies the z component of an element. The higher the 'closer' it is to the viewport. */
  }

  #bgObjCon {
    font-family: 'Megrim', cursive;
  }

    #bgObjCon > div {
      animation-name: floatOne;
      animation-duration: 5s;
      animation-fill-mode: forwards;
      animation-iteration-count: infinite; /* Constantly repeats. */
      transition-timing-function: ease-in-out;
      color: #333; /* Sets the color of the font. */
    }
/*Elements*/
  h1 {
    font-family: 'Megrim', cursive; /* Sets the font to be used. */
    font-size: 1000%;
    text-align: center;
    padding-left: auto;
    padding-right: auto;
    box-sizing: border-box; /* Icludes the padding and border in the total width of the element. */
  }
/*Classes*/
  /*On first load*/
    .bgObjBig {
      font-size: 600%;
    }

    .bgObjMed {
      font-size: 400%;
    }

    .bgObjSmall {
      font-size: 200%;
    }
```

## css/forumStyles.css

This is the CSS code that stylises the forum.

```css
/*Classes*/
  .forumObj { /*This applies to any type of post in a thread.*/
	   border-style: none;
	   border-radius: 3px;
     display: flex; /* Displays as a flexbox. This element is now flexible, whcich gives it access to the flex properties. */
   }

   .forumCon > em, .forumCon > b, .forumCon > ul, .forumCon > t, .forumCon > br, ul > li, em > b, b > em, t > em, t > b, t > ul, t, em { /*t = I created this tag element.*/
     color: #EFEFEF; /*Makes sure that the rule is directly taken by each element in a forumObj ready for nightmode. */
   }

   .forumCon {
   	 min-width: 90%;
   	 max-width: 90%;
   	 padding: 5% 5% 5% 5%; /* All elements inside leave a border around the edge of the menubar and the rest of the viewport. */
   }

   .forumNameTag {
   	 float: right;
   }
   /*Post types*/
       .message { /*Reply to an original post.*/
	        cursor: pointer;
	        margin-left: 5%;
	        width: 95%;
       }

       .reply { /*Reply to a message.*/
	        float: right;
	        margin-left: 10%;
	        width: 90%;
          margin-bottom: 2%;
        }
```

## css/general.css

This is the CSS code that stylises HTML elements from different types of pages.

```css
/*IDs*/
  #dayChangeBtn {
    position: fixed; /* Stays at a specifed location and does not move based on the nearest, upper nested relative element.*/
    right: 2vw;
    top: 2vw;
    z-index: 1000; /* Stays on top of all elements so that it can always be accessed. */
    color: #666;
  }

/*Elements*/
  ::selection { /* The style of highlighted text. */
    background-color: inherit; /* No change in style to keep the website style continous. */
    color: inherit;
  }

  body {
    background-color: #EFEFEF;
    color: #333;
    font-family: 'Comfortaa', cursive;
    overflow: hidden; /* Any excess width or height of an element to the outside of the viewport is hidden away from view. */
    box-sizing: border-box;
    cursor: default;
  }

  div {
    display: block; /* Displayed as a section of the webpage. */
    box-sizing: border-box;
  }

  p {
    margin-bottom: -1%; /* Pushes text downwards. */
  }

  hr {
    border-width: thin;
    color: #333;
    border-style: solid;
  }
/*Classes*/
  .floatAesthetic {
    box-shadow: 7px 7px 17px #AAA; /* Creates a shadow effect from an element. */
  }

  .text {
    font-size: 100%;
    max-width: 100%;
    min-width: 100%;
    overflow-wrap: break-word; /* Defines where breaks are places in words when overflowing. This will only break a word if a word cannot be placed on its own line without overflowing. */
    color: #EFEFEF;
  }

  .text > b, text > em {
    color: #EFEFEF;
  }
  /*Coloured text classes*/
    .coloredText {
      -webkit-text-fill-color: transparent; /* Lets us see the background behind a peice of text. */
      -webkit-background-clip: text !important; /* Sets the background of an element to only be displayed where the tet is present. */
    }

    /*Colors*/
      .redPurple { /*xY: starts with x colour ends with Y colour.*/
        background: linear-gradient(to top right, #F2092C 0%, #B50FC4 100%); /* Creates a color gradient from the bottom left corner to the top right corner.*/
      }

      .greenYellow {
        background: linear-gradient(to top right, #1FC63A 0%, #E8D31E 100%);
      }

      .orangeBlue {
        background: linear-gradient(to top right, #F2870A 0%, #11E3C3 100%);
      }

  /*Other*/
    .large{ /* Occupies all space availabale to the element in the x-axis.*/
      min-width: 100%;
      max-width: 100%;
      max-height: 10%;
      min-height: 10%;
      font-size: 100%;
      margin-left: 0;
    }
  /*Results from queries*/
    .strip {
      min-width: 100%;
      max-width: 100%;
      border-radius: 3px;
      border-style: none;
      color: #EFEFEF;
      font-size: 150%;
      cursor: pointer;
      padding: 5%;
    }

      .strip > hr { /* Sets the colour of the horizontal rule within a strip element. */
        color: #EFEFEF;
      }
```

## css/homeStyles.css

This contains the CSS code that is specific to the home page.

```css
/*IDs*/
  #homeTitle {
    font-size:  1000%;
    font-weight: 700; /* Sets the boldness of the text. */
    margin-top: -2%; /* Pushes the element upwards. */
  }

  #homeSubTitle {
    font-size:  300%;
    font-weight: 400;
    margin-top: -2%;
    color: #333;
  }
```

## css/inputStyles.css

This contains the CSS code specific to stylising input elements of HTML forms.

```css
/* IDs */
#dnaSequenceT , #dnaSequenceTE { /* Sets the DNA sequence to its typical, capitalised form. */
  text-transform: uppercase;
}
/* Elements */
  select, input, textarea, .button {
    background: rgba(238, 238, 238, 0.7); /* Sets the background to be partially transparent. */
    color: #333;
    border-style: none;
    border-radius: 3px;
    cursor: pointer;
    width: 100%;
    min-height: 8%;
    font-family: "Roboto Mono", monospace;
    margin-right: auto;
    margin-left: auto;
    margin-bottom: 2%;
    padding: 5px;
  }

  select > option { /* This makes sure that the optiosn are always visible regaerdless of colour mode. */
    color: #333;
  }

  form {
    max-width: 90%;
    min-width: 90%;
    margin: 0;
    margin-top: 2%;
  }

  textarea {
    min-width: 100%;
    max-width: 100%;
    min-height: 40%;
    max-height: 40%;
  }

    textarea::-webkit-scrollbar {
      background-color: #EFEFEF;
    }

    textarea::-webkit-scrollbar-thumb {
      background-color: #333;
    }
    /*Red button*/
      .redBtn {
        background-color: #E50000 !important;
        border-color: #E50000 !important;
        color: #EFEFEF !important;
      }

      .redBtn:hover, #signOutBtn:hover { /*Added specifity to overide button hover for signOutBtn.*/
        background-color: #CC0000 !important;
        border-color: #CC0000 !important;
      }

      .redBtn > p {
        transform: translateY(50%); /* Moves the element downwards by half of the space available to it. */
      }
  /*Button*/
    .button {
      text-align: center;
      min-height: 12%;
      max-height: 12%;
      cursor: pointer;
      p {
        display: block;
        height: 50%;
        transform: translateY(-50%);
        font-size: 120%;
      }
    }

    button:hover, input:hover, select:hover, textarea:hover  { /*Used hover here AND javaScript for input hovering so as */
      background-color: #EFEFEF !important;     /*to include submit inout buttons. Also to achieve hover effect.*/
      border-color: #EFEFEF !important;
    }
  .removeDeleteButton {
    margin-left: 5%;
    margin-right: 5%;
    margin-top: 2%;
    margin-bottom: -2%;
  }
  /*Removes chrome slection effects.*/
    textarea:hover,
    input:hover,
    textarea:active,
    input:active,
    textarea:focus,
    input:focus,
    button:focus,
    button:active,
    button:hover,
    label:focus,
    .btn:active,
    .btn.active
    {
      outline:0px !important;
      -webkit-appearance:none;
    }
```

## css/mediaQueries.css

This contains CSS code changes depending on the dimensions of the screen of the device that the user is using.

```css
@media only screen and (max-width: 500px) { /*For mobile displays (or any other display that ahs a maximum width of 500 pixels. This is NOT the width of the viewport.)*/
  #menuCon {
    max-height: 5%;
    min-height: 5%;
    max-width: 100%;
    min-width: 100%;
    display: block;
    margin-bottom: 5%;
    z-index: 101;
  }

  #menuCon p {
    display: inline-block;
    top: 50%;
    transform: translateY(-50%);
    margin-left: 2%;
    margin-right: 2%;
  }

  #dayChangeBtn { /* Moves the button the chnage the color scheme to a more suitable location. */
    top: 0.5%;
    right: 1%;
  }

  #accountPage, #homePage, #toolPage, #newsPage, #aboutPage, #forumPage, #forumSingleViewPage, #toolSingleViewPage, #searchPage {
    margin-left: 5%; /* Lets us occupy slightly more room now that the menu bar has gone, and keeps a margin for easier reading.*/
    margin-right: 5%; /* ^ */
    margin-top: 12%; /* Shifts all pages downwards to make room for the new postion of the menu bar. */
  }

  .doubleForm {
    margin-bottom: 5%;
    min-width: 100%;
    max-width: 100%;
  }

  .menuRule {
    display: none; /* No horizontal rules in the menu bar in the new position. */
  }
}
```

## css/pages.css

This is the CSS code that is specific to stylising the fundamental parts of the pages.

```CSS
/*IDs*/
  #mainCon { /*Where all non-menu content is.*/
    opacity: 0;
    position: fixed; /* Occupys the entire viewport. */
    top: 0px; /* ^ */
    left: 0px; /* ^ */
    width: 100%;
    height: 100%;
    min-width: 1px; /*Fills up if nothing is in it.*/
    min-height: 1px; /* ^ */
    animation-duration: 4s; /*For first load.*/
    animation-iteration-count: 1;
    animation-fill-mode: forwards;
    overflow-x: hidden; /*No horizontal scrolling*/
  }

  #mainCon::-webkit-scrollbar { /* Sets the properties of the scrollbar background. */
    background-color: #EFEFEF;
    width: 1%;
  }

  #mainCon::-webkit-scrollbar-thumb { /* Sets the properties of the scrollbar 'thumb' (the bit that we use to scroll). */
    background-color: #333;
  }

  #menuCon { /*Where all menu content is.*/
    position: fixed;
    width: 5%;
    height: 100%;
    min-width: 1px;
    min-height: 1px;
    background-color: #333;
    text-align: center;
    color: #EFEFEF;
  }

  #homePage { /*This is the first page to load so it needs to be already viewable when the page loads.*/
    opacity: 1;
  }

/*Classes*/
  /*Menu-specific classes*/
    .material-icons {
      cursor: pointer;
    }

    .menuRule {
      border-color: #EFEFEF;
      width: 70%;
    }

    .postBtn { /*This is the button for posting a thread/message in a thread.*/
      display: none;
    }

  .page { /*A page is where specific content. E.g. All tool content is in the tool page. Not to be confused with a web page.*/
    opacity: 0;
    position: absolute; /* Specifies a particular location within the nearest, upper nested relative element. This is usually the body. */
    top: 0px;
    left: 0px;
    width: 91%;
    height: 96%;
    min-width: 1px;
    min-height: 1px;
    margin-left: 7%;
    margin-right: 2%;
    margin-bottom: 4%;
    margin-top: 2%;
    animation-iteration-count: 1;
    animation-duration: 1s;
    animation-fill-mode: forwards;
    transition-timing-function: ease-in-out;
  }

  /*Classes found within pages.*/
    .textCon { /*Puts elements below the subtitle*/
      width: 100%;
      height: 100%;
      min-width: 1px;
      min-height: 1px;
      margin-top: -5%;
    }

    .subTitle {
      font-size: 400%;
    }
```

## css/popUp.css

This CSS code is used to style any "pop ups". These are HTML blocks that contain notifications or forms for the user to fill out. They are useful at drawing attention.

```css
/*Classes*/
  .boardConPU{ /*This is what dims the background*/
    position: absolute;
    top: 0px;
    left: 0px;
    min-width: 100vw; /* 1vw = viewport width/100 */
    min-height: 100vh; /* 1vh = viewport height/100 */
    max-width: 100vw;
    max-height: 100vh;
    background-color: rgba(64, 64, 64, 0.6);
  }

  .popUpBox { /*This is what makes the actual pop up.*/
    position: relative;
    border-radius: 3px;
    border-style: none;
    border-width: 5px;
    max-width: 70%;
    min-width: 70%;
    max-height: 70%;
    min-height: 70%;
    margin-left: auto;
    margin-right: auto;
    margin-top: 7.5%;
    box-sizing: border-box;
    z-index: 999;
    box-shadow: 2px 2px 10px #222;
    overflow-y: auto; /* Lets us scroll through the content of the notification. */
  }

    .popUpBox::-webkit-scrollbar { /* Sets the properties of the scrollbar backgound. */
      background-color: transparent;
      width: 1%;
    }

    .popUpBox::-webkit-scrollbar-thumb {  /* Sets the properties of the scrollbar draggable part. */
      background-color: #EFEFEF;
    }

    .textConPU { /*This is where the body of the pop up goes.*/
      color: #EFEFEF;
      margin-top: 5%;
      margin-left: 5%;
      margin-bottom: 5%;
      margin-right: 5%;
    }

    .titlePU {
      color: #EFEFEF;
      font-size: 300%;
      font-weight: bolder;
    }

    .crossPU { /*For closing the pop up*/
      float: right;
      cursor: pointer;
    }

    /*Pop up inputs*/

      .textareaPU {
        background-color: #EFEFEF;
        border-color: #EFEFEF;
        text-transform: none; /* Keeps the user inputted text as unchnaged in term sof capitalisation. */
        color: #333;
      }

      .subjectTextareaPU {
        max-height: 20%;
        min-height: 20%;
      }
```

## css/search.css

This CSS code stylises the page that contains the searching function.

```css
/*IDs*/
#searchBoxForm {
  text-align: center;
  padding: 5% 5% 5% 5%;
}

#inputsCon {
  max-width: 100%;
  min-width: 100%;
}

  #searchType { /* The part of the search form which lets us specify what type of data we are looking for. */
    color: #EFEFEF;
    max-width: 30%;
    min-width: 30%;
    margin-right: 2%;
    float: left;
    font-size: 110%;
  }

  #searchBox { /* The part of the search form which we type into. */
    color: #EFEFEF;
    max-width: 50%;
    min-width: 50%;
    font-size: 110%;
    margin-right: 2%;
  }

  #searchBtn {
    color: #EFEFEF;
    max-width: 16%;
    min-width: 16%;
    float: right;
    max-height: 8%;
    min-height: 8%;
    font-size: 110%;
  }
```

## css/toolStyles.css

The "tool" is the histone modification interpreter. This file contains the CSS code that stylises the tool page.

```css
/*IDs*/
  #histoneModDiv { /*For containing the histone modification buttons.*/
    border-width: 5px;
    border-radius: 3px;
    background-color: rgba(238, 238, 238, 0.7);
  }

  #hmodBg { /*For displaying the mod sequence*/
    border-style: none;
    border-radius: 3px;
    color: #333;
    min-width: 100%;
    max-width: 100%;
    min-height: 40%;
    overflow-y: auto;
    background: #EFEFEF;
  }

  #diseaseForm, #toolForm {
    border-radius: 3px;
    padding: 5% 5% 5% 5%;
    color: #EFEFEF;
  }

  #removeHistoneBtn { /* For creating a sequence. */
    margin-right: 0%;
  }

  #removeHistoneBtnTE { /* For editing a sequence */
    margin-right: 1%;
  }
/*Classes*/
  .histoneMod {
    max-width: 47%;
    min-width: 47%;
    margin: 1% 1% 1% 0%; /*Top right bottom left*/
    max-height: 10%;
    min-height: 10%;
    display: inline-block;
    box-sizing: content-box; /* Sets the width of the element to not include the border and margin. Lets us space out elements using margin. */
    border-style: none;
    border-radius: 3px;
  }

  .histoneMod:hover {
    background-color: #EFEFEF;
    border-color: #EFEFEF;
    color: #333;
  }

  .toolCon {
    margin: 5% 5% 5% 5%;
  }

  .sequenceDiseaseTitle {
    font-size: 120%;
    color: #333;
    font-weight: bolder;
  }
```

## php/onload/account.php

This file contains code to do with the account page that is executed once `index.php` is loaded.

```php
<?php
  if(isset($_GET["hash"]) && isset($_GET["email"])){ // If the user is activating their account
    $hash = $_GET["hash"]; // Get the hash from the URL query
    $ea = $_GET["email"];
    $q = "UPDATE users SET hash = NULL WHERE emailAddress='$ea' AND hash='$hash'"; // Set the hash to NULL so that the user can log in.
    $r = mysqli_query($db, $q); // Processes the query $q and returns the result.
    if($r){ // If the result actually returns a result.
      echo($popupTop);
      echo("<p>You can now sign in.</p>");
      echo($popupBottom);
      // Display a notification letting them know that activation was successfull to the user.
    }
  }

  $emailAddress = isset($trim["emailAddressSI"]) ? $trim["emailAddressSI"] : "rf@example.com"; # If the user has tried to sign in, save the inputted email address so that they can correct their mistakes.
  # w = x ? y : z ; Means w is set to y if x is true. If x is false set w to z.
  if(isset($_COOKIE["user"])){ // If the user is signed in.
    $q = "SELECT * FROM users WHERE uid=".$_COOKIE['user'];
    $r = mysqli_query($db, $q);
    $num = mysqli_num_rows($r); // Get the number of returned rows.
    if($num == 1){ // If user account is returned (each user row is unqiue so it must be equal to 1).
      $name = ($userRow[1]." ".$userRow[2]); // Get the name.
      $ea = $userRow[3]; // Get the email address.
      $a = 'Standard account'; // Initialise the admin string variable.
      if($admin == TRUE){ // If the user is an admin
        $a = 'Admin account';
      }
      echo('<script>loadUserData("'.$name.'", "'.$ea.'", "'.$a.'");</script>'); // Display the user account data and password form.
    }
    else if($num != 1) { // If the account is not unqiue, must be malicous. Or if it does not exist we need to display the correct account page.
      echo('<script>document.cookie = "user=;expires='.(time()-100).'"; document.getElementById("accountPage").innerHTML = \''.$accountMenu.'\';</script>'); # Delete user cookie if user not found in database.
      echo('<script>loadAccountPage('.$emailAddress.');</script>'); # Display the sign in and sign up forum
    }
    else {
      echo('<script>loadAccountPage("'.$emailAddress.'");</script>');
    }
  }
  else {
    echo('<script>loadAccountPage("'.$emailAddress.'");</script>');
  }
?>
```

## php/onload/forum.php

This forum-page related code is executed once `index.php` is loaded.

```php
<?php
	function convert($m) { # Converts artificial mark-up to HTML.
		$chars = ['[i]', '[/i]', '[b]', '[/b]', '[l]', '[/l]', '[li]', '[/li]']; # All of thw artificial mark up tags.
		$replaceChars = ['<em>', '</em>', '<b>', '</b>', '<ul>', '</ul>', '<li>', '</li>']; # HTMl tags.
		for($i=0;$i<count($chars);$i++){
			$m = str_replace($chars[$i], $replaceChars[$i], $m);
			# Replace any sub-string within the message $m, that matches the artifical mark up tag, with the actual HTML mark up. DO this for each artificial mark up tag.
		}
		return $m;
	}

	# Displays all threads.
	$q = "SELECT tid, subject, uid, dateTime FROM thread ORDER BY dateTime DESC"; # Fetches all threads and order them from newest to oldest to keep the forum relevent to current times.
	$r = mysqli_query($db, $q);

	$num = mysqli_num_rows($r); # Gets the number of rows that were returned.

	echo("<script>document.getElementById('forumPageContent').innerHTML =\"<br><br>"); # Print some javascript that executes once the page has loaded. This javascript prints out HTML mark-up.
	if($num < 1){ # If no threads exist, display a message to indicate this to the user.
		echo("Nothing here! Try posting a new thread by clicking on the 'write' icon at the bottom of the bar.");
	}
	else {
		$threads = new queue($num); # Create a new thread object.

		# Note that the order of the array that is reutrned by mysqli_fetch_array is in the order of the table attributes specified in the query, or in the order of the attributes of the table if they are not specified in the query.
		while($row = mysqli_fetch_array($r)){ # For each thread.
			$fn = mysqli_fetch_array(mysqli_query($db, "SELECT firstName FROM users WHERE uid=".$row[2]))[0]; #  Get the first name of the user who posted it.
			$s = $row[1]; # Fetches the subject of the thread.
			if(strlen($s) > 25){ # This makes sure that only a set amount of the subject text is printed so as not to overflow the strip.
				$s = substr($s, 0, 25)."...";
			}
			$html = "<div class='strip greenYellow floatAesthetic' onclick='window.location.href = `index.php?page=forum&thread=$row[0]`;'><a>$s</a><hr><br><a style='float: right;'>$fn at ".$row[3]." GMT</a>";
			# Each thread displayed as a strip with a link to the forum sing view so that we can view a single thread.
			if($admin == TRUE){ # If the user is an admin, they should have the power to delete inappropriate threads. Display a form to do that.
				$html .= "<form action='".$_SERVER["REQUEST_URI"]."' method='post'><input name='deleteTid' type='hidden' value='".$row[0]."'/><input class='removeDeleteButton' type='submit' value='Delete'/></b></form>";
			}
			$html .= "</div><br>";
			$threads->append($html); # Adds the HTML markup as an element to the back of the queue.
		}

		do {
			echo($threads->get()); # Display the element at the front of the queue.
			$threads->pop(); # Remove that that element.
		} while ($threads->isEmpty() == FALSE); # Repeat until the queue is empty.
	}
	echo("\";</script>");
	# ---

	if(isset($_GET["thread"]) && isset($_COOKIE["user"])){ # If we are in are viewing a single thread on forumSingleViewPage.
		$tid = $_GET["thread"]; # Get the thread id.
		$r = mysqli_query($db, "SELECT mid FROM message WHERE tid = ".$tid); # Select all messages
		$num = mysqli_num_rows($r); # Find the number of returned rows for part of the length of the queue.
		while($mid = mysqli_fetch_array($r)[0]){
			$num += mysqli_num_rows(mysqli_query($db, "SELECT rid FROM replies WHERE mid = ".$mid)); # Adds the number of replies for each number to the total length of the queue.
		}

		$posts = new queue($num+1); # This will contain the html with the original post first, then each message followed by their replies in order of oldest to newest. We add one to the queue length to account for the original post.

		echo("<script>menuBtnClick('forumSingleView'); document.getElementById('forumSingleViewPageContent').innerHTML=`"); # Begin the JavaScript script.
		$r = mysqli_query($db, "SELECT subject, message, firstName, dateTime FROM thread INNER JOIN users ON thread.uid = users.uid WHERE tid=".$tid); # Fetch the original post of the thread and the user's first name who psoetd it.
		$rowT = mysqli_fetch_array($r); # Store the extracted data in an array.
		$m = convert($rowT[1]); # Converts artificial mark up to valid HTML in the message.
		$OPHTML = "<br><br><div class='forumObj greenYellow floatAesthetic'><div class='forumCon'><b>$rowT[0]</b><br><t>$m</t><br><em class='forumNameTag'>$rowT[2] at $rowT[3] GMT</em></div></div>"; # Displays the original post.

		$posts->append($OPHTML);

		$r = mysqli_query($db, "SELECT message, firstName, mid, dateTime FROM message INNER JOIN users ON message.uid = users.uid WHERE tid=".$tid); # Fetch data on all messages to the original post including the first name of the use who posted it.
		while($rowM = mysqli_fetch_array($r)){ # For each message.
			$m = convert($rowM[0]); # Retrive the message body.
			$mHTML = "<br><div class='forumObj message redPurple floatAesthetic'><div class='forumCon' onclick='document.getElementById(\"replyingPU\").style.display = \"block\"; document.getElementById(\"midPR\").value = \"".$rowM[2]."\";'><div><t>$m</t><br><em class='forumNameTag'>$rowM[1] at $rowM[3] GMT</em></div>";
			# The above line displays the message.
			if($admin == TRUE){ # Dispaly a form to delete the message if the user is an admin.
				$mHTML .= '<form action="'.$_SERVER['REQUEST_URI'].'" method="post"><input name="deleteMid" type="hidden" value="'.$rowM[2].'"/><input class="removeDeleteButton" type="submit" value="Delete" onclick="document.getElementById(\'replyingPU\').style.display = \'none\';"/></b></form>';
			}
			$mHTML .= "</div></div><br>";
			$posts->append($mHTML);
			$rR = mysqli_query($db, "SELECT message, firstName, rid, dateTime FROM replies INNER JOIN users ON replies.uid = users.uid WHERE replies.mid=".$rowM[2]); # Fetch all the repleis foreach message, aswell as the firstname of the suer who posted it.
			while($rowR = mysqli_fetch_array($rR)){
				$m = convert($rowR[0]);
				$rHTML = "<div class='forumObj reply orangeBlue floatAesthetic'><div class='forumCon'><t>$m</t><br><em class='forumNameTag'>".$rowR[1]." at ".$rowR[3]." GMT</em>";
				#Display the reply.
				if($admin == TRUE){ # Dispaly a form to delete the repy if the user is an admin.
					$rHTML .= '<form action="'.$_SERVER['REQUEST_URI'].'" method="post"><input name="deleteRid" type="hidden" value="'.$rowR[2].'"/><input class="removeDeleteButton" type="submit" value="Delete"/></b></form>';
				}
				$rHTML .= "</div></div><br>";
				$posts->append($rHTML);
			}
		}

		do {
			echo($posts->get()); # Print the post
			$posts->pop(); # Remove it from the queue.
		} while($posts->isEmpty() == FALSE); # Repeat until the queue is empty.
		echo("<br><br>`;</script>"); # End the JavaScript script.
	}
?>
```

## php/onload/search.php

This search-page related code is only executed once `index.php` has loaded.

```php
<?php
  if(isset($_COOKIE["user"])){ # Only display the page if the user has signed in.
    # For searching through forum posts and sequences. selected="selected" is used instead of just selected as it is XHTML compliant. This also indicated the default option of select.
    $search = isset($trim["searchValue"]) ? $trim["searchValue"] : "Search"; # Get the previously entered value searched for if the user has searched before. Otherwise set toa  defualt value.
    $searchType = isset($trim["searchType"]) ? $trim["searchType"] : "";
    echo('<script>document.getElementById("searchFormCon").innerHTML=`'); # Start the JavaScript script.
    echo('<form id="searchBoxForm" action="index.php?page=search" method="post">
      <div id="inputsCon">
        <select id="searchType" name="searchType" class="redPurple floatAesthetic">'); # Begin displaying the search form.
    $optionKeyValues = ['currentUserSequences', 'My sequences', 'currentUserDiseases', 'My diseases', 'currentUserThreads', 'My threads', 'sequences', 'All sequences', 'diseases', 'All diseases', 'threads', 'All theads'];
    # Above line creates an array that holds the value (the key) and the actual text (the value) displayed to the user, for each user in the respective format. E.g. w, x, y, z where w is a value and x is a peice of text and w,x and y,z are pairs of values.
    $optionDictionary = new dictionary($optionKeyValues); # Create a dictionary object using the constructor defined in dictionary.php and the array previosuly defined.
    if($searchType != ""){ # If the user has entered a search term before, display that as the default type of search to be conducted.
      $submittedValue = $optionDictionary->read($searchType); # Gets the text to display to the user.
      echo('<option value="'.$searchType.'" selected="selected">'.$submittedValue.'</option>'); # Prints the option.
      $result = $optionDictionary->remove($searchType); # Removes the option from the dictionary so it is not reprinted.
    }
    $optionKeys = $optionDictionary->keys; # Fetches all keys from the dictionary.
    for($i=0;$i<count($optionKeys);$i++){ # For each key.
      $currentKey = $optionKeys[$i];
      $currentValue = $optionDictionary->read($currentKey); # Fetch the value associated with that key.
      echo('<option value="'.$currentKey.'">'.$currentValue.'</option>'); # Print the option.
    }
    echo('</select>
        <input id="searchBox" name="searchValue" class="redPurple floatAesthetic" type="text" value="'.$search.'" info="Search" onfocus="clearValue(this); selected(this);" onblur="restoreValue(this); deselected(this);"/>
        <input id="searchBtn" class="redPurple floatAesthetic" type="submit"/>
      </div>
      <input name="page" value="tool" type="hidden"/>
    </form><br><br><br><br>'); # Print the rest of the form. $search holds the default value of the search term input.
    echo('`;</script>'); # End the JavaScript script.
  }
?>
```

## php/onload/tool.php

The code in this file is executed once `index.php` loads. It deals with loading the tool page.

```php
<?php
  if(isset($_COOKIE["user"])){ # Only display the page if the user has signed in.
    # For searching through forum posts and sequences. selected="selected" is used instead of just selected as it is XHTML compliant. This also indicated the default option of select.
    $search = isset($trim["searchValue"]) ? $trim["searchValue"] : "Search"; # Get the previously entered value searched for if the user has searched before. Otherwise set toa  defualt value.
    $searchType = isset($trim["searchType"]) ? $trim["searchType"] : "";
    echo('<script>document.getElementById("searchFormCon").innerHTML=`'); # Start the JavaScript script.
    echo('<form id="searchBoxForm" action="index.php?page=search" method="post">
      <div id="inputsCon">
        <select id="searchType" name="searchType" class="redPurple floatAesthetic">'); # Begin displaying the search form.
    $optionKeyValues = ['currentUserSequences', 'My sequences', 'currentUserDiseases', 'My diseases', 'currentUserThreads', 'My threads', 'sequences', 'All sequences', 'diseases', 'All diseases', 'threads', 'All theads'];
    # Above line creates an array that holds the value (the key) and the actual text (the value) displayed to the user, for each user in the respective format. E.g. w, x, y, z where w is a value and x is a peice of text and w,x and y,z are pairs of values.
    $optionDictionary = new dictionary($optionKeyValues); # Create a dictionary object using the constructor defined in dictionary.php and the array previosuly defined.
    if($searchType != ""){ # If the user has entered a search term before, display that as the default type of search to be conducted.
      $submittedValue = $optionDictionary->read($searchType); # Gets the text to display to the user.
      echo('<option value="'.$searchType.'" selected="selected">'.$submittedValue.'</option>'); # Prints the option.
      $result = $optionDictionary->remove($searchType); # Removes the option from the dictionary so it is not reprinted.
    }
    $optionKeys = $optionDictionary->keys; # Fetches all keys from the dictionary.
    for($i=0;$i<count($optionKeys);$i++){ # For each key.
      $currentKey = $optionKeys[$i];
      $currentValue = $optionDictionary->read($currentKey); # Fetch the value associated with that key.
      echo('<option value="'.$currentKey.'">'.$currentValue.'</option>'); # Print the option.
    }
    echo('</select>
        <input id="searchBox" name="searchValue" class="redPurple floatAesthetic" type="text" value="'.$search.'" info="Search" onfocus="clearValue(this); selected(this);" onblur="restoreValue(this); deselected(this);"/>
        <input id="searchBtn" class="redPurple floatAesthetic" type="submit"/>
      </div>
      <input name="page" value="tool" type="hidden"/>
    </form><br><br><br><br>'); # Print the rest of the form. $search holds the default value of the search term input.
    echo('`;</script>'); # End the JavaScript script.
  }
?>
```

## php/onload/toolsingleview.php

The code here executes once `index.php` is loaded. It deals with loading the tool single view page.

```php
<?php
  if(isset($_GET["sequence"])){ # If we are retriving a specific sequence.
    echo("<script>document.getElementById('toolSingleViewPageContent').innerHTML='");
    $nsid = $_GET["sequence"];
    $row = mysqli_fetch_array(mysqli_query($db, "SELECT name, notes, uid FROM nucelosomesequence WHERE nsid=$nsid"));
    $name = $row[0]; # Fetch the sequence name.
    $notes = $row[1];
    $ownerid = $row[2];
    echo('<p class="sequenceDiseaseTitle">'.$name.'</p><br><hr>'); # And display it.
    $r = mysqli_query($db, "SELECT histoneMods, ndsid, nid FROM nucleosome WHERE nsid=$nsid ORDER BY nsid"); # Fetch data on all nucleosome related to this sequence.
    $counter = 0; # Defines the nucleosome number (to give it an arbitary name). Orders from first to last (ascending by default).
    $num = mysqli_num_rows($r); # Length of the queue.
    $nucleosomesHTML = new queue($num); # Contains a queue of nucleosome HTML blocks.
    $allComponents = new dictionary(["allDNA", "", "allMods", ""]);
    $nucleosomes = []; # Two dimensional array that will contain the name number and the nucelosome ID for each nucleosome. Name Number (counter) : nucleosome id.
    while($row = mysqli_fetch_array($r)){
      $nid = $row[2];
      $html = '<div class="strip redPurple floatAesthetic">';
      $counter++;
      $html .= '<p class="text"><b>Nucleosome '.$counter.'</b><p><br><hr>'; # Print the next nucleosome number in the sequence.
      $dnaSequence = mysqli_fetch_array(mysqli_query($db, "SELECT DNASequence FROM nucleosomednasequence WHERE ndsid=".$row[1]))[0];
      $allDNA = $allComponents->read("allDNA").$dnaSequence;
      $errorCode = $allComponents->editValue("allDNA", $allDNA);
      $html .= '<p class="text"><em>DNA Sequence:</em><br>'.$dnaSequence.'</p><p class="text"><em>Histone Mods:</em><br>';
      $allMods = $allComponents->read("allMods").$row[0];
      $errorCode = $allComponents->editValue("allMods", $allMods);
      $mods = explode(",", $row[0]);
      for($i=0;$i<count($mods);$i++){
        $mod = (int)$mods[$i]; # Select the current histone modification ID (hmid).
        $modName = mysqli_fetch_array(mysqli_query($db, "SELECT name FROM histonemods WHERE hmid=".$mod))[0]; # Select the histone modification name
        $final = $modName;
        $value = $i <=> (count($mods)-2); # Returns -1 if $i is less than count($mods)-1, 0 if equal two or 1 if greater than. This is called the spaceship operator.
        if($value == -1){ # Concatenate a comma if this ISN'T the last mod in the sequence.
          $final .= " , ";
        }
        $html .= $final;
      }
      if($uid == $ownerid){ # Checks to see if the user owns this sequence.
        $html .= '<form action="index.php?page=tool&sequence='.$nsid.'" method="post"><input name="nidTD" type="hidden" value="'.$nid.'"/><input name="submitTD" class="removeDeleteButton" type="submit" value="Delete" onfocus="selected(this);" onblur="deselected(this);"/></form>';
        # Displays the form for deleting a nucleosome from the sequence if the user owns this sequence.
      }
      $html .= '</div><br><br>';
      $nucleosomesHTML->append($html);
      array_push($nucleosomes, [$counter, $nid]); # Append the array.
    }
    $r = mysqli_query($db, "SELECT disease.did, disease.name FROM disease INNER JOIN nucelosomesequence ON disease.did=nucelosomesequence.did WHERE nsid=$nsid"); # Selects the disease associated with the sequence if such a relationship exists.
    $row = mysqli_fetch_array($r);
    $did = $row[0]; # Fetch the disease ID.
    $diseaseName = "";
    if($r){ # If the sequence is related to a disease, fetch the disease's name.
      $diseaseName = $row[1];
    }
    $allMods = explode(",", $allComponents->read("allMods"));
    $result = interpretHistoneModSequence($allMods, $db); # Determine the change in expression of the DNA sequence at hand.
    if($result > 0){ # If the overall change in expression activates the expression, display this to the user using the + sign.
      $result = "+".$result;
    }

    if($r){ # Only display a disease association of one exists.
      echo('<div class="strip greenYellow floatAesthetic" onclick="window.location.href=`index.php?page=tool&disease='.$did.'`"><p class="text">This sequence is derived from: <b>'.$diseaseName.'</b></p></div><br><br>');
    }
    echo('<div class="strip greenYellow floatAesthetic"><p class="text"><b>Overall</b></p><p class="text"><em>Full DNA Sequence: <br></em>'.$allComponents->read("allDNA").'</p><p class="text"><em>Expression Change Result: <br></em>'.$result.'</p><br><p class="text"><em>Notes: </em><br>'.$notes.'</p></div><br><br>');
    # This must be printed first before everthing else so that it stays at the top of the page. It displays data specific to the overall sequence.
    # === Now print the breakdown of the sequence.
    do {
      echo($nucleosomesHTML->get());
      $nucleosomesHTML->pop();
    } while($nucleosomesHTML->isEmpty() == FALSE);
    # ===
    if($uid == mysqli_fetch_array(mysqli_query($db, "SELECT uid FROM nucelosomesequence WHERE nsid=$nsid"))[0] || $admin == TRUE){ # Editing for owner and admin only.
      if($notes == ""){
        $notes = isset($trim["notesTEO"]) ? $trim["notesTEO"] : "Notes"; # Determine the default value of the notes using the tenary operator.
      }
      echo ('<form id="toolForm" class="orangeBlue floatingAesthetic" action="index.php?page=tool&sequence='.$nsid.'" method="post"><p class="text">Edit Overall Details</p><br><br><select name="diseaseAssociationTEO">'); # Start displaying the edit form for the overall sequence.
      if($did){ # If the disease-sequence relationship exists, set that to be the first option in the drop down input.
        echo('<option selected="selected" value="'.$did.'">'.$diseaseName.'</option>');
        $q = "SELECT did, name FROM disease WHERE did!=$did"; # Then fetch all diseases that are not the disease just displayed.
      }
      else { # Print all diseases in alphabetical order.
        $q = "SELECT did, name FROM disease ORDER BY name DESC";
      }
      global $q; # Get the query we just determiend.
      echo('<option value="NULL">No association</option>'); # Display No association as the second/first option depending on whether a disease association already existed or not.
      $r = mysqli_query($db, $q);
      while($row = mysqli_fetch_array($r)){ # Print each remaining/all diseases as options for the disease association of the sequence depending on whether a disease association already existed or not.
        echo('<option value="'.$row[0].'">'.$row[1].'</option>');
      }
      echo('</select><textarea name="notesTEO" info="Notes" onfocus="clearValue(this); selected(this);" onblur="restoreValue(this); deselected(this);">'.$notes.'</textarea>');
      echo('<input name="nameTEO" type="text" value="'.$name.'" info="Name" onfocus="clearValue(this); selected(this);" onblur="restoreValue(this); deselected(this);"/>');
      echo('<input type="hidden" name="submittedTEO" value="TRUE"/><input type="submit"" name="submitTEO" value="Edit" onfocus="selected(this);" onblur="deselected(this);"/></form>');
      # Display the rest of the form with the deault values determined earlier.
      echo('<form id="toolForm" class="orangeBlue floatingAesthetic" action="index.php?page=tool&sequence='.$nsid.'" method="post"><p class="text">Edit</p><br><br><select name="nucleosomeTE" onfocus="selected(this);" onblur="deselected(this);"><option value="NULL">New nucleosome</option>');
      # Begin displaying the nucleosome-specific edit form.
      foreach($nucleosomes as $n){ # Print each nuclesome as an option to edit. Before we printed an option to create a new nucleosome.
        echo('<option value="'.$n[1].'"> Nucleosome '.$n[0].'</option>');
      }
      $dnaTE = isset($trim["dnaSequenceTE"]) ? $trim["dnaSequenceTE"] : "ATCG";
      $modsStrTE = isset($trim["histoneModsTE"]) ? $trim["histoneModsTE"] : "";
      $viewingModsTE = "";
      $mods = explode(",", $modsStrTE);
      foreach($mods as $mod){
        $name = mysqli_fetch_array(mysqli_query($db, "SELECT name FROM histonemods WHERE hmid=".intval($mod)))[0];
        $viewingModsTE .= $name." ";
      }
      echo('</select><textarea id="dnaSequenceTE" name="dnaSequenceTE" maxlength="127" info="ATCG" onkeydown="dnaInputCheck(this);" onfocus="clearValue(this); selected(this);" onblur="restoreValue(this); deselected(this);">'.$dnaTE.'</textarea><br><br><div id="hmodBg"><div id="hmodSequenceTE" class="toolCon">'.$viewingModsTE.'</div></div><br><br>');
      echo('<div id="histoneModDiv"><div class="toolCon"><div id="removeHistoneBtnTE" class="button histoneMod" onclick="removeLastHmod(`hmodSequenceTE`, `histoneModsTE`);">Remove</div>');
              $q = "SELECT hmid, name FROM histonemods";
              $r = mysqli_query($db, $q);
              while($row = mysqli_fetch_array($r)){
                echo('<div class="button histoneMod" onclick="addHmod(`'.$row[1].'`, `'.$row[0].'`, `hmodSequenceTE`, `histoneModsTE`);">'.$row[1].'</div>');
              }
      echo('</div></div><input id="histoneModsTE" name="histoneModsTE" type="hidden" value="'.$modsStrTE.'"/>');
      echo('<input type="submit" name="submitTE" value="Edit"/><input type="hidden" name="submittedTE" value="TRUE"/>');
    }
    echo("';</script>");
  }
  else if(isset($_GET["disease"])){ # If we are retriving the data on a specific disease.
    echo("<script>document.getElementById('toolSingleViewPageContent').innerHTML='");
    $did = $_GET["disease"]; # Fetch the ID of the disease from the URL query.
    $row = mysqli_fetch_array(mysqli_query($db, "SELECT name, notes, uid FROM disease WHERE did=$did"));
    $name = $row[0];
    $notes = $row[1];
    if(is_null($notes)){
      $notes = isset($trim["notesTEO"]) ? $trim["notesTEO"] : "Notes";
    }
    $ownerid = $row[2];
    echo('<br><div class="strip greenYellow floatAesthetic"><p class="text"><b>'.$name.'</b></p><br><p>'.$notes.'</p></div><br><br>');
    # Thhe above line displays the overview information on the disease.
    $r = mysqli_query($db, "SELECT nsid, name, notes FROM nucelosomesequence WHERE did=$did"); # Fetches all seqeunces associated with this disease.
    while($row = mysqli_fetch_array($r)){ # Ieterates through each sequence associated with this disease.
      $nsid = $row[0];
      echo('<div class="strip redPurple floatAesthetic" onclick="window.location.href=`index.php?page=tool&sequence='.$nsid.'`;"><p class="text">'.$row[1].'</p><br><p class="text">'.$row[2].'</p>');
      # Above line displays the currnent sequence.
      if($uid == $ownerid){ # Checks to see if the user owns this sequence.
        echo('<form action="index.php?page=tool&disease='.$did.'" method="post"><input name="nsidTD" type="hidden" value="'.$nsid.'"/><input name="submitTD" class="removeDeleteButton" type="submit" value="Remove" onfocus="selected(this);" onblur="deselected(this);"/></form>');
        # Above line displays a form to remove association of the sequence to the disease.
      }
      echo('</div><br><br>');
    }

    if($uid == $ownerid){ # Editing for owner only.
      # This displays the form for editing the disease, usign default values determined earlier.
      echo ('<form id="toolForm" class="orangeBlue floatingAesthetic" action="index.php?page=tool&disease='.$did.'" method="post"><p class="text">Edit Overall Details</p><br><br>');
      echo('<textarea name="notesTEO" info="Notes" onfocus="clearValue(this); selected(this);" onblur="restoreValue(this); deselected(this);">'.$notes.'</textarea>');
      echo('<input name="nameTEO" type="text" value="'.$name.'" info="Name" onfocus="clearValue(this); selected(this);" onblur="restoreValue(this); deselected(this);"/>');
      echo('<input type="hidden" name="submittedTEO" value="TRUE"/><input type="submit"" name="submitTEO" value="Edit" onfocus="selected(this);" onblur="deselected(this);"/></form>');
    }
    echo("';</script>");
  }
?>
```

## php/onload/onloadLOAD.php

This file groups together all of the other file in the **/onload** directory and loads them within this file. This file can then be loaded itself into `index.php`. This simplifies the code in `index.php` so that it can be more easily maintained.

```php
<?php
  # Require_once makes sure that only one version of the file is included and prevents the execution of the rest of this script if it is not present - preventing a user from running an errornous version of this program.
  require_once("account.php"); # Always load the account page PHP script.
  if(isset($_COOKIE["user"])){ # Only load these PHP scripts if the user is signed in, so that only activated (therefore valid) accounts have access to the main website, so that actions the user does can be attributed to the account.
    require_once("forum.php");
    require_once("tool.php");
    require_once("toolSingleView.php");
    require_once("search.php");
  }
  echo("<script>"); # Start the JavaScript script.
  if(isset($_GET["page"])){ # If the user is being redirected to a particular page.
    if(isset($_COOKIE["user"])){
      switch($_GET["page"]){ # Checks the value of the page URL query.
        case "account": # If this value is account.
          echo("menuBtnClick('account');"); # Redirect to the account page.
          break; # Break out of the switch statement.
        case "forum":
          if(isset($_GET["thread"])){ # If we are displaying a particular thread then we need to pop up the single view page.
            echo("menuBtnClick('forumSingleView');");
          }
          else{
            echo("menuBtnClick('forum');");
          }
          break;
        case "help":
          echo("menuBtnClick('help');");
          break;
        case "news":
          echo("menuBtnClick('news');");
          break;
        case "tool":
          if(isset($_GET["sequence"]) || isset($_GET["disease"])){ # Same goes for histone modification sequences. A disease will contain many smaller sequences, and this information should be displayed on one page, so we need to display on the single view page.
            echo("menuBtnClick('toolSingleView');");
          }
          else{
            echo("menuBtnClick('tool');");
          }
          break;
        case "search":
          echo("menuBtnClick('search');");
          break;
        default: # If there is an invalid value, redirect to the home page.
          echo("menuBtnClick('home');");
          break;
      }
    }
    else if($_GET["page"] == "account"){ # Let the user switch between the account and home pages via the URL query, but nothing else.
      echo("menuBtnClick('account');");
    }
    else {
      echo("menuBtnClick('home');");
    }
  }
  echo("</script>"); # Ends the JavaScript script.
?>
```

## php/submission/account.php

The code here executes once a form from the account page is submitted.

```php
<?php
  if(isset($trim["submittedSU"])){ # If the user wants to sign up a new account.
    $fn = strip_tags($trim["firstNameSU"]); # Strip tags removes any HTMl tags, preventing XSS attacks. $trim is where all posted data is located.
    $sn = strip_tags($trim["secondNameSU"]); # We use names of inputs to extract data specific to a given input. Eg, $trim["x"] extracts data from the input with name x.
    $ea = strip_tags($trim["emailAddressSU"]);
    $pw = $trim["passwordConSU"];
    $in = $trim["interestSU"];
    $hash = hashing32($pw); # Uses my hash algorithm to produce a 32 character string.
    $errors = [];
    if(mysqli_num_rows(mysqli_query($db, "SELECT * FROM users WHERE emailAddress='$ea'")) > 0){ # If the email address submitted is not unqiue.
      $errors = ["Email addresss already in use."]; # Throw an error.
    }

    if($pw == "Password"){
      $errors = ["Password cannot be default."];
    }

    if($in == "Interest"){
      $errors = ["Please select and interest."];
    }

    if(empty($errors)){ # If the array contaisn no errors.
      $q = "INSERT INTO users VALUES(NULL, '$fn', '$sn', '$ea', '".crypt($pw, 'iN5@n1tY')."', '$in', '$hash', 0)"; # Create a new account, that is unactivated as it contains a hash value.
      # In the above line, crypt() is a hash algorithm that uses a salt to encrypt the password.
      $r = mysqli_query($db, $q);
      mail($ea, "Nomios - Please Confirm Your Account", "Confirm your account by clicking copy and pasting the following url: http://127.0.0.1/index.php?page=account&email=$ea&hash=$hash", "FROM: reiss1999@gmail.com");
      # Above line sends and email to the user's address.
      echo($popupTop);
      echo("<p>Take a look at your inbox for a confirmation before you sign in.</p>");
      echo($popupBottom);
      # Above three lines indicate to the user that they must activate their account.
    }
    else { # If there are errors, display them to the user so that they can correct them.
      echo($popupTop);
      foreach($errors as $error){
        echo("<p>".$error."</p>");
      }
      echo($popupBottom);
    }
  }
  else if(isset($trim["submittedSI"])){ # If the user is trying to sign in.
    $ea = $trim["emailAddressSI"];
    $pw = $trim["passwordSI"];
    $q = "SELECT uid FROM users WHERE emailAddress='$ea' AND password='".crypt($pw, 'iN5@n1tY')."'"; # Attempt to fetch the uid of a user that mathces the mail address and encrypted password entered.
    $r = mysqli_query($db, $q);
    if(mysqli_num_rows($r) == 1){ # If there is a one, unique result then it means that the account exists and is valid (a valid account is one where only one copy of it exists because malicous attakcs could bemade through duplicate accounts).
      if(mysqli_num_rows(mysqli_query($db, "SELECT uid FROM users WHERE emailAddress='$ea' AND hash IS NULL")) == 1){ # If the user's account ahs been activated.
        echo('<script>document.cookie = "user='.mysqli_fetch_array($r)[0].';expires='.(time()+(3600*24)*30).'"; reload();</script>'); # Create a cookie storing the user ID using JavaScript and refresh the page to prevent form resubmission.
      }
      else { # Otherwise, the user's account is not activated.
        echo($popupTop);
        echo("<p>The account has not yet been confirmed. Please check your inbox.</p>");
        echo($popupBottom);
      }
    }
    else { # No account mathces the encrypted-password and email address combination.
      echo($popupTop);
      echo("<p>Either the account does not exist or the password was incorrect.</p>");
      echo($popupBottom);
    }
  }
  else if(isset($trim["submittedAE"])){ # If the user is editing their password
    $pw = $trim["passwordAE"];
    $pc = $trim["passwordConAE"]; # Password confirmation
    $pwc = crypt($pw, 'iN5@n1tY'); # Encrypt the password
    $errors = [];
    if($pw !== $pc){ # !== not same type or same value.
      $errors = ["Passwords do not match."];
    }

    if($pw == "Password" || $pwc == "password" || $pwc == mysqli_fetch_array(mysqli_query($db, "SELECT password FROM users WHERE uid = ".$_COOKIE["user"][0]))){
      # If the password has already been entered or it was left at its default value throw an error. Don't need to check $pw to see if it matches the already entered password as if it mathces $pwc, then $pwc will throw an error for it.
      $errors = ["Password is invalid."];
    }

    if(empty($errors)){ # If no errors are found.
      $q = "UPDATE users SET password = '".$pwc."' WHERE uid = ".$_COOKIE["user"];
      $r = mysqli_query($db, $q); # Update the password.
      echo($popupTop);
      echo("<p>Password updated.</p>");
      echo($popupBottom);
    }
    else {
      echo($popupTop);
      foreach($errors as $error){
        echo("<p>".$error."</p>");
      }
      echo($popupBottom);
    }
  }
?>
```

## php/submission/deletingScripts.php

This code is executed when a delete HTML form is submitted from the tool/tool single vie pages.

```php
<?php
  if(isset($trim["deleteNsid"])){
    $nsid = $trim["deleteNsid"]; # Fetch ID for the nucleosome sequence from the form.
    $r = mysqli_query($db, "DELETE FROM nucelosomesequence WHERE nsid=$nsid"); # Delete the row that contains this id from the database
    echo('<script>window.location.href="index.php?page=search";</script>'); # Redirect to the search page.
  }
  else if(isset($trim["deleteDid"])){
    $did = $trim["deleteDid"]; # Fetch ID for the disease from the form.
    $r = mysqli_query($db, "DELETE FROM disease WHERE did=$did"); # Delete this disease row from the database using the ID.
    echo('<script>window.location.href="index.php?page=search";</script>');
  }
  else if(isset($trim["nidTD"]) && isset($_GET["sequence"])){
    $nid = $trim["nidTD"];
    $r = mysqli_query($db, "DELETE FROM nucleosome WHERE nid=$nid");
    echo('<script>window.location.href="index.php?page=tool&sequence='.$nsid.'";</script>');
    # Redirect to the sequence from which the nucelosome was deleted from to prevent accidental resubmission.
  }

  # All forum deleting stuff is handled in submission/forum.php
?>
```

## php/submission/forum.php

This code is executed when a HTML form from the forum is submitted.

```php
<?php
  # Deleting forum items
  if(isset($trim["deleteMid"])){
    # $trim["deleteMid"] holds the ID for the message.
    $r = mysqli_query($db, "DELETE FROM message WHERE mid=".$trim['deleteMid']); # Delete the message we want to delete.
    $r = mysqli_query($db, "DELETE FROM replies WHERE mid=".$trim['deleteMid']); # Delete all attached replies to that message.
    echo('<script>window.location.href = "index.php?'.$_SERVER['QUERY_STRING'].'";</script>'); # Redirected to the same thread on the forum single view page.
  }
  else if(isset($trim["deleteTid"])){ # Delete an entire thread.
    $r = mysqli_query($db, "DELETE FROM thread WHERE tid=".$trim['deleteTid']); # Delete the thread.
    $r = mysqli_query($db, "SELECT mid FROM message WHERE tid=".$trim['deleteTid']); # Select all messages in this thread.
    while($row = mysqli_fetch_array($r)){ # For each message
      $mid = $row[0]; # Fetch the message ID for deleting the replies associated with each message because the replies do not contain a tid column.
      $r = mysqli_query($db, "DELETE FROM message WHERE mid=".$mid); # Delete the message using this ID.
      $r = mysqli_query($db, "DELETE FROM replies WHERE mid=".$mid); # Delete replies associated with this message.
    }
    echo('<script>window.location.href = "index.php?page=forum";</script>'); # Redirect to the forum to view all threads.
  }
  else if(isset($trim["deleteRid"])){ # Delete a reply.
    $r = mysqli_query($db, "DELETE FROM replies WHERE rid=".$trim['deleteRid']);
    echo('<script>window.location.href = "index.php?'.$_SERVER['QUERY_STRING'].'";</script>'); # Redirected to the same thread on the forum single view page.
  }
  # ===

  if(isset($trim["submittedPT"])){ # If the user is posting a new thread.
    $s = strip_tags($trim["subjectPT"]);
    $m = strip_tags($trim["messagePT"]);
    $errors = [];
    if($s == "Subject" || $m == "Message"){
      $errors = ["Cannot post default values."];
    }
    if(empty($errors)){ # If there are no errors.
      $q = "INSERT INTO thread VALUES(0, $uid, '$s', '$m', CURRENT_TIMESTAMP)"; # Add a new row to the thread table. CURRENT_TIMESTAMP gets the current time and date of the server.
      $r = mysqli_query($db, $q);
      $tid  = mysqli_fetch_array(mysqli_query($db, "SELECT tid FROM thread ORDER BY tid DESC LIMIT 1"))[0]; # Fetch the ID of the latest thread and therefore, the one we just submitted.
      echo('<script>window.location.href = "index.php?page=forum&thread='.$tid.'";</script>'); # Redirect to the singleViewPage to view on this particular thread.
    }
    else {
      echo($popupTop);
      foreach($errors as $error){
        echo("<p>".$error."</p>");
      }
      echo($popupBottom);
    }
  }
  else if(isset($trim["submittedPM"])){ # If the user is posting a message to a thread.
    $m = strip_tags($trim["messagePM"]);
    $tid = $_GET["thread"]; # Get the id of the thread we are currently viewing (must be viewing a thread on a singleViewPage to post a message to it).
    $errors = [];
    if($m == "Message"){
      $errors = ["Cannot post a default value."];
    }

    if(empty($errors)){
      $r = mysqli_query($db, "INSERT INTO message VALUES(0, $tid, $uid, '$m', CURRENT_TIMESTAMP)"); # Insert a new row to the message table.
      echo('<script>window.location.href = "index.php?page=forum&thread='.$tid.'";</script>');# Reload the page to prevent resubmission.
    }
    else {
      echo($popupTop);
      foreach($errors as $error){
        echo("<p>".$error."</p>");
      }
      echo($popupBottom);
    }
  }
  else if(isset($trim["midPR"])){ # If the user is posting a reply to a message.
    $m = strip_tags($trim["messagePR"]);
    $tid = $_GET["thread"];
    $errors = [];
    if($m == "Message"){
      $errors = ["Cannot post a default value."];
    }

    if(empty($errors)){
      echo('<script>window.location.href = "index.php?page=forum&thread='.$tid.'";</script>'); # Reload the page to prevent resubmission.
      $r = mysqli_query($db, "INSERT INTO replies VALUES(NULL, ".$trim['midPR'].", $uid, '$m', CURRENT_TIMESTAMP)"); # Insert a new row to the replies table.
    }
    else {
      echo($popupTop);
      foreach($errors as $error){
        echo("<p>".$error."</p>");
      }
      echo($popupBottom);
    }
  }
?>
```

## php/submission/search.php

This code is executed when one the search page form is submitted.

```php
<?php
  if(isset($trim["searchValue"]) && isset($trim["searchType"])){
    $searchTerm = $trim["searchValue"]; # This contains the text that the user is actually searching for.
    $searchType = $trim["searchType"]; # This tells us what filter to apply to the search.
    if($searchTerm == "Search"){ # We cannot search for the text 'Search'.
      $searchTerm = ""; # This sets the value so that it lists all records.
    }

    $q = "";
    switch($searchType){ # This is used to determine which query to process based on the filter. % is a wildcard character.
      case "threads":
        $q = "SELECT tid, subject, firstName FROM thread INNER JOIN users ON thread.uid=users.uid WHERE subject LIKE '%$searchTerm%' OR message LIKE '%".$searchTerm."%' ORDER BY tid DESC";
        break;
      case "sequences":
        $q = "SELECT nsid, name, firstName FROM nucelosomesequence INNER JOIN users ON nucelosomesequence.uid=users.uid WHERE name LIKE '%".$searchTerm."%'";
        break;
      case "diseases":
        $q = "SELECT * FROM disease WHERE name LIKE '%".$searchTerm."%'";
        break;
      case "currentUserSequences":
        $q = "SELECT nsid, name, firstName FROM nucelosomesequence INNER JOIN users ON nucelosomesequence.uid=users.uid WHERE users.uid=$uid AND name LIKE '%".$searchTerm."%'";
        break;
      case "currentUserThreads":
        $q = "SELECT tid, subject, firstName FROM thread INNER JOIN users ON thread.uid=users.uid WHERE subject LIKE '%$searchTerm%' OR message LIKE '%".$searchTerm."%' AND users.uid=".$uid." ORDER BY tid DESC";
        break;
      case "currentUserDiseases":
        $q = "SELECT * FROM disease WHERE name LIKE '%".$searchTerm."%' AND uid=".$uid;
        break;
      default:
        $errors = ["No search type indicated."];
        break;
    } # All queries will return records created by the user. The 'currentUser' queries return only records created by the current user.
    $r = mysqli_query($db, $q);
    echo("<script>document.getElementById('searchResultsCon').innerHTML=\"");
    if(mysqli_num_rows($r) > 0){ # Only display results if any rows exist from the query.
      while($row = mysqli_fetch_array($r)){
        if($searchType == "threads" || $searchType == "currentUserThreads"){ # Searching for threads.
          $s = $row[1];
          if(strlen($s) > 25){
            $s = substr($s, 0, 25)."...";
          }
          # This displays the results of the retrived records, when one is clicked it will redirect to a page displaying all of the records='s information.'
          echo("<div class='strip greenYellow floatAesthetic' onclick='window.location.href = `index.php?page=forum&thread=".$row[0]."`;'><a>$s</a><a style='float: right;'> | ".$row[2]."</a>"); # Each thread displayed.
          if($admin == TRUE){ # Allows admins to delete any thread.
            echo("<form action='".$_SERVER["REQUEST_URI"]."' method='post'><input name='deleteTid' type='hidden' value='".$row[0]."'/><input class='removeDeleteButton' type='submit' value='Delete'/></b></form>");
          }
          echo("</div><br>");
        }
        else if($searchType == "sequences" || $searchType == "currentUserSequences"){ # Searching for histone modification sequences.
          # This displays the results of the retrived records, when one is clicked it will redirect to a page displaying all of the records='s information.'
          echo("<div class='strip greenYellow floatAesthetic' onclick='window.location.href = `index.php?page=tool&sequence=".$row[0]."`;'><a>$row[1]</a><a style='float: right;'> | ".$row[2]."</a>"); # Each thread displayed.
          if($uid == mysqli_fetch_array(mysqli_query($db, "SELECT uid FROM nucelosomesequence WHERE nsid=".$row[0]))[0]){ # Allows the user to delete their own sequences but no-one elses.
            echo("<form action='".$_SERVER["REQUEST_URI"]."' method='post'><input name='deleteNsid' type='hidden' value='".$row[0]."'/><input class='removeDeleteButton' type='submit' value='Delete'/></b></form>");
          }
          echo("</div><br>");
        }
        else { # If we are searching diseases. Else can only be this as any other value of $searchType is an input error.
          echo("<div class='strip greenYellow floatAesthetic' onclick='window.location.href = `index.php?page=tool&disease=".$row[0]."`;'><a>".$row[1]."</a></a>"); //Each thread displayed.
          if($uid == mysqli_fetch_array(mysqli_query($db, "SELECT uid FROM disease WHERE did=".$row[0]))[0]){ # Allows the owner to delete their own diseases.
            echo("<form action='".$_SERVER["REQUEST_URI"]."' method='post'><input name='deleteDid' type='hidden' value='".$row[0]."'/><input class='removeDeleteButton' type='submit' value='Delete'/></b></form>");
          }
          echo("</div><br>");
        }
      }
    }
    else { # If no results display a message to indicate this.
      echo("No results.");
    }
    echo("\";</script>");
  }
?>
```

## php/submission/tool.php

This code is executed when one of the HTML forms from the tool page are submitted.

```php
<?php
  if(isset($trim["submittedD"])){
    $name = strip_tags($trim["diseaseNameD"]);
    $notes = checkNotes(strip_tags($trim["notesD"])); # Sets notes to be SQL compliant by encapsulating them with quotation marks if not default value and if a default value set it to be NULL.
    $errors = [];
    if($name == "Disease name"){
      $errors = ["Name cannot be default value"];
    }
    else { # This checks to see if the disease is already in the database. One or the other as 'Disease Name' cannot be submitted as a value so it wont be in the database.
      $r = mysqli_query($db, "SELECT name FROM disease"); # Selects all of the name in the disease table.
      while($row = mysqli_fetch_array($r)){ # For each row in the table.
        if($row[0] == $name){ # Checks if the user-inputted name is the same as the current row.
          $errors = ["Disease already in the database"];
        }
      }
    }

    if(empty($errors)){
      $q = "INSERT INTO disease VALUES(NULL, '$name', $notes, $uid)"; # Insert a new row into the disease table.
      $r = mysqli_query($db, $q);
      echo("<script>window.location.href = 'index.php?page=search&diseaseSubmitted=TRUE';</script>"); # Reload the page to prevent resubmission.
    }
    else {
      echo($popupTop);
      foreach($errors as $error){
        echo('<p>'.$error.'</p>');
      }
      echo($popupBottom);
    }
  }
  if(isset($trim["submittedT"])){ # This is for submitting a new sequence.
    $dnaStr = strtoupper($trim["dnaSequenceT"]); # Convert text to be capitalised (it is not changed by CSS).
    $modsStr = $trim["histoneModsT"];
    $name = strip_tags($trim["sequenceNameT"]);
    $notes = checkNotes(strip_tags($trim["notesT"]));
    $diseaseAssoc = $trim["diseaseAssociationT"];
    $errors = [];
    if($modsStr == "" || $dnaStr == "ATCG" || $name == "Name"){
      $errors = ["Cannot use default values."];
    }
    $r = mysqli_query($db, "SELECT name FROM nucelosomesequence WHERE uid=$uid"); # Select the names from all nucleosomesequences.
    while($row = mysqli_fetch_array($r)){ # For each returned row
      if($row[0] == $name){ # Check if the name matches with name of a sequence that the user already owns.
        $errors = ["You already have a sequence with that name."];
        break;
      }
    }
    if(empty($errors)){
      $dnaStrs = str_split($dnaStr, 127); # Produces nucleosome-sized chunks of DNA.
      $modsStrs = explode("|", $modsStr); # Produces a chunk of histone modifications for each specified nucleosome.
      $did = "";
      if($diseaseAssoc != "NULL"){
        $did = (int)$diseaseAssoc; # Cast the string value of the disease association as an integer.
      }
      else {
        $did = "NULL";
      }
      $dnaStrsLen = count($dnaStrs); # Length of the $dnaStrs array.
      $modsStrsLen = count($modsStrs); # Length of the $modsStrs array.
      $difference = $dnaStrsLen - $modsStrsLen; # Difference between the two.
      if($dnaStrsLen > $modsStrsLen){ # If we have more DNA chunks than histone modifications
        for($i=0;$i<abs($difference);$i++){ # Difference between the two values (abs() returns the magnitude of a number).
          array_push($modsStrs, " "); # Append spaces so that each nucleosome has "mods" so that it can be inserted into the database.
        }
      }
      else if($dnaStrsLen < $modsStrsLen){ # If we have more histone chunks than DNA chunks, add a new DNA chunk of unknown bases.
        for($i=0;$i<abs($difference);$i++){ # Difference between the two values (abs() returns the magnitude of a number).
          array_push($dnaStrs, "NNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN"); # Append unknown DNA sequence N signifies unknown, 127 Ns in each append.
        }
      }
      $queries = []; # Array that holds all of our nucleosome queries ONLY.
      $r = mysqli_query($db, "INSERT INTO nucelosomesequence VALUES(NULL, $uid, $did, '".$name."', $notes)"); # Inserts the nucleosome sequence into its table.
      $nsid = mysqli_fetch_array(mysqli_query($db, "SELECT nsid FROM nucelosomesequence WHERE uid=$uid AND name='".$name."'"))[0]; # Fetches the ID of this new record.
      for($i=0;$i<count($dnaStrs);$i++){ # For each nucleosome (defined by number of nucleosome DNA chunks).
        $dna = $dnaStrs[$i]; # Current DNA.
        $mods = $modsStrs[$i]; # Current histone mods.
        $ndsid = -1; # Initialise the ID of the nucleosome DNA sequence.
        $dnaFound = checkDNA($dna); # Check to see if DNA is already in the database.
        if($dnaFound == TRUE){
          $ndsid = mysqli_fetch_array(mysqli_query($db, "SELECT ndsid FROM nucleosomednasequence WHERE DNASequence='".$dna."'"))[0]; # Fetch the ndsid of the mathcing DNA sequence.
        }
        else{ # If no DNA match is found
          $r = mysqli_query($db, "INSERT INTO nucleosomednasequence VALUES(NULL, '".$dna."')"); # Insert a new DNA sequencn into the databse.
          $r = mysqli_query($db, "SELECT ndsid FROM nucleosomednasequence ORDER BY ndsid DESC LIMIT 1");
          $ndsid = mysqli_fetch_array($r)[0]; # Fetches the id of the dna sequence we just inserted.
        }
        array_push($queries, "INSERT INTO nucleosome VALUES(NULL, $ndsid, '".$mods."', $nsid)"); # Adds a query to the queries array that inserts a new record to the nucelosome.
      }
      foreach($queries as $query){ # Execute all nucleosome insertion queries.
        $r = mysqli_query($db, $query);
      }
      #echo('<script>window.location.href="index.php?page=search&sequenceSubmitted=TRUE";</script>'); # Redirect so that the user does not resubmit the data.
    }
    else{
      echo($popupTop);
      foreach($errors as $error){
        echo('<p>'.$error.'</p>');
      }
      echo($popupBottom);
    }
  }
?>
```

## php/submission/toolSingleView.php

This code is executed when a HTML form from the tool single view page is submitted.

```php
<?php
  if(isset($trim["submittedTE"]) && isset($_GET["sequence"])){ # Editing a sequence.
    $nucleosome = $trim["nucleosomeTE"];
    $mods = $trim["histoneModsTE"];
    $dna = strtoupper($trim["dnaSequenceTE"]);
    $q = "";
    $matchResult = checkDNA($dna); # Check to see if DNA is already in the database.
    $ndsid = -1; # Not yet assigned with an actual ID value, but needs to be decared so that it has the correct variable scope.
    if($matchResult == FALSE) {
      $r = mysqli_query($db, "INSERT INTO nucleosomednasequence VALUES(NULL, '$dna')"); # Insert a new record into the nucleosomednasequence table.
      $ndsid = mysqli_fetch_array(mysqli_query($db, "SELECT ndsid FROM nucleosomednasequence ORDER BY ndsid DESC LIMIT 1"))[0]; # Fetch the ID from the latest record (the one we just submitted).
    }
    else {
      $ndsid = mysqli_fetch_array(mysqli_query($db, "SELECT ndsid FROM nucleosomednasequence WHERE DNASequence='".$dna."'"))[0]; # Fetch the nucelsome DNA sequence ID
    }
    if($nucleosome == "NULL"){ # This means that we need to create a new record.
      $q = "INSERT INTO nucleosome VALUES(NULL, $ndsid, '$mods', ".$_GET["sequence"].")"; # Query for creating a new nucleosome record.
    }
    else { # This means we need to update a record.
      $q = "UPDATE nucleosome SET ndsid=$ndsid, histoneMods='$mods' WHERE nid=$nucleosome"; # Update the values of an already existing nucleosome.
    }
    $r = mysqli_query($db, $q);
    echo('<script>window.location.href="index.php?page=tool&sequence='.$nsid.'";</script>'); # Reload the page to see the differences.
  }
  else if(isset($trim["submittedTEO"]) && isset($_GET["sequence"])){ # If the overview details of a sequence is being edited.
    $nsid = $_GET["sequence"];
    $notes = checkNotes(strip_tags($trim["notesTEO"]));
    $name = strip_tags($trim["nameTEO"]);
    $did = $trim["diseaseAssociationTEO"];
    $errors = [];

    if($name == "Name"){
      $errors = ["Cannot use default values."];
    }

    if(empty($errors)){
      $r = mysqli_query($db, "UPDATE nucelosomesequence SET notes=$notes, name='$name', did=$did WHERE nsid=$nsid"); # Update the nucleosome sequence record with the new overview data.
      echo('<script>window.location.href="index.php?page=tool&sequence='.$nsid.'";</script>'); # Reload the page to see the differences.
    }
    else {
      echo($popupTop);
      foreach($errors as $error){
        echo('<p>'.$error.'</p>');
      }
      echo($popupBottom);
    }
  }
  else if(isset($trim["submittedTEO"]) && isset($_GET["disease"])){ # If the user is editing the disease overview.
    $did = $_GET["disease"];
    $notes = strip_tags($trim["notesTEO"]);
    $name = strip_tags($trim["nameTEO"]);
    $errors = [];

    if($name == "Name"){
      $errors = ["Cannot use default values."];
    }

    if(empty($errors)){
      $r = mysqli_query($db, "UPDATE disease SET notes='$notes', name='$name' WHERE did=$did"); # Update the overview values of the disease.
      echo('<script>window.location.href="index.php?page=tool&disease='.$did.'";</script>'); # Reload the page so that we can see the differences.
    }
    else {
      echo($popupTop);
      foreach($errors as $error){
        echo('<p>'.$error.'</p>');
      }
      echo($popupBottom);
    }
  }
  else if(isset($trim["nsidTD"]) && isset($_GET["disease"])){ # If the user is removing a sequence-disease association.
    $nsid = $trim["nsidTD"]; # Fetch the ID of the sequence.
    $r = mysqli_query($db, "UPDATE nucelosomesequence SET did IS NULL WHERE nsid=$nsid"); # Stop it from being related to disease record.
    echo('<script>window.location.href="index.php?page=tool&disease='.$did.'";</script>'); # Reload the disease page to see the differences.
  }
?>
```

## php/submission/submissionONLOAD.php

This code is executed when `index.php` loads. It performs the same function to the `onloadLOAD.php` script but deals with scripts that are executed when a HTML form is submitted instead.

```php
<?php
  if(isset($_COOKIE["user"])){ # Submission scripts to be loaded for signed in users only.
    require_once("forum.php");
    require_once("tool.php");
    require_once("search.php");
    require_once("toolSingleView.php");
    require_once("deletionScripts.php");
  }
  require_once("account.php"); # The page that anyone can submit too.
?>
```

## php/dictionary.php

This code contains the class definition for the dictionary data structure.

```php
<?php
  class dictionary{
    public function dictionary($keyValues = []){ # This constructor is called when a dictionary object is instantiated.
      $this->keys = [];
      $this->values = [];
      for($i=0;$i<count($keyValues);$i++){
        if(gettype($i/2) == "double"){ # If integer is not formed when didvided by two, must be an odd number.
          array_push($this->values, $keyValues[$i]);
        }
        else{ # Else must be even so a key.
          array_push($this->keys, $keyValues[$i]);
        }
      }
    }

    private function getKeyPosition($key){ # Fetch the position of the key. From thsi we can tell if a key exists or not. Only the class definition can call it.
      if(!in_array($key, $this->keys)){ # If the key is not in the array.
        return -1; # Because if no position is found, an error code of -1 s thrown.
      }
      else {
        $pos = array_search($key, $this->keys); # Fetch the position of the key.
        return $pos;
      }
    }

    public function checkKeyExists($key){ # Made a new function with a new name to be more developer friendly as the method name is more relevant.
      $val = dictionary::getKeyPosition($key);
      return ($val = -1 ? FALSE : TRUE); # Return TRUE if a key does have a positiona dn therefore exists. Else, false.
    }

    public function add($key, $value){
      array_push($this->keys, $key); # Append the new key to the end of the $keys array.
      array_push($this->values, $value); # Append the new value to the end of the $values array.
      return 0;
    }

    public function remove($key){
      $pos = dictionary::getKeyPosition($key);
      if($pos != -1){ # Make sure the getKeyPosition() functions has not returned an error.
        array_splice($this->keys, $pos, 1); # Remove the key and value pair from the arrays at the specified postion, $pos. This function shifts indexes too if an element is removed in the middle of an array.
        array_splice($this->values, $pos, 1); # ^
        return 0; # 0 is the success code.
      }
      else {
        return 1;
      }
    }

    public function read($key){ # Read a value froma key.
      $pos = dictionary::getKeyPosition($key);
      if($pos != -1){
        $value = $this->values[$pos]; # Retrive the value at the specified location.
        return $value;
      }
      else {
        return 1;
      }
    }

    public function editValue($key, $value){ # Edit the value as the specified key.
      $pos = dictionary::getKeyPosition($key);
      if($pos != -1){
        $this->values[$pos] = $value; # Set value at the corressponding point of its key in the $values array.
        return 0;
      }
      else {
        return 1;
      }
    }

    public function readAll(){
      $finalArray = []; # Initialise the array.
      for($i=0;$i<count($this->keys);$i++){
        array_push($finalArray, $this->keys[$i]);
        array_push($finalArray, $this->values[$i]);
        # Creates an array in the format x, y where x is the key and y is the value.
      }
      return $finalArray;
    }
  }
?>
```

## php/hashing32.php

This code is the hashing algorithm that I created called `hashing32`.

```php
<?php
   function hashing32($str){ # Takes a given string (str) and returns a hashed string with a length of 256 charcaters.
     $chars = str_split($str); # Splits the string into individual charcaters (as the default chunk length of each element of the returned array is 1).
     $finalStr = "";
     foreach ($chars as $char) {
       $ascii = ord($char); # Retrives the ascii denary value of the character.
       $ascii *= 817513877; # ascii denary multiplied by the a large prime number. Malicous users must divide the string by this value in order to find the charcter of the string used accurately,
       # as the reurned value of this statement could be a multiple of many different characters. Therefore malicous users cannot be certain (without enough computational power and time) what the charcater is.
       $hex = dechex($ascii); # Converts the denary value to a hexidecimal form.
       $finalStr .= $hex;
     }
     if(strlen($finalStr) < 32){
       for($i = 0; $i < (32 - strlen($finalStr)); $i++){
         $finalStr .= "1";
       }
     }
     else if(strlen($finalStr) > 32){
       $finalStr = str_split($finalStr, 32)[0]; # Retrive the first 32 charcters of the string.
     }
     return $finalStr;
   }
?>
```

## php/queue.php

This code contains the class definition for the queue data structure.

```php
<?php
  class queue { # Defines the circular queue object class.
    public function queue($length = 100){ # This defines the constructor for instatiations of the class.
      $this->elements = []; # Contains the array of elements in the current queue. Each element contains a value.
      $this->headerPointer = 0; # Contains the index of the elment at the beginning of the queue.
      $this->backPointer = 0; # Contaisn the index for the last element in the queue.
      $length <= 0 ? $this->length = 100 : $this->length = $length; # If the length is lower than or equal to 0, set the length of the queue to a default. Otherwise it is set to a user defiend length.
      for($i = 0; $i < $length; $i++){ # Fills the array with "empty" elements so that the array if fixed in size from instantiation.
        $this->elements[$i] = "";
      }
    }

    public function get(){ # Gets the first value in the queue.
      return $this->elements[$this->headerPointer];
    }

    public function pop(){ # Removes the first element in the queue from the array.
      $this->elements[$this->headerPointer] = ""; # An "empty" element.
      $this->headerPointer++; # Increments the headerPointer to the next element in the queue.
      if(($this->headerPointer + 1) > $this->length){ # If the header pointer is beyond the length of the queue, we move it back to point to the beginning of the queue.
        $this->headerPointer= 0;
      }
    }

    public function append($value){ # Adds an element to back of a queue.
      $this->elements[$this->backPointer] = $value; # Sets the value at the back of the queue.
      if(($this->backPointer + 1) == $this->length){ # If the next element would otherwsie be added to the beyond the queue. Set the backPointer to the front.
        $this->backPointer = 0;
      }
      else {
        $this->backPointer++; # otherwise increment the back pointer so that we can add to the next element.
      }
    }

    public function isEmpty(){
      if($this->get() == ""){ # If the first element in the queue is empty then the entire queue must be empty.
        return TRUE;
      }
      else {
        return FALSE;
      }
    }
  }
?>
```

## php/toolFunctions.php

This file contains functions that are used in either **submission/tool.php** or **onload/tool.php**.

```php
<?php
  # Functions for both the edit tool form and the create tool form, for both submission and on-load pages.
  function interpretHistoneModSequence($mods, $db){
    $result = 0; # Initilaise the result varibale.
    foreach($mods as $mod){ # For each mod in the sequence.
      $q = "SELECT effectType, magnitude FROM histonemods WHERE hmid=".intval($mod);
      $r = mysqli_query($db, $q); # Fetch the magnitude of its effect and whether or not it is repressive.
      $row = mysqli_fetch_array($r); # Fetch the actualy values of these.
      if($row[0] == "1"){ # If a repressive effect, decrease $result.
        $result -= $row[1];
      }
      else { # If an activator effect, increase $result.
        $result += $row[1];
      }
    }
    return $result;
  }

  function checkDNA($dna){ # This checks to see if a DNA sequence has already been added to the database.
    global $db;
    $r = mysqli_query($db, "SELECT DNASequence FROM nucleosomednasequence"); # Fetches all current DNA sequences form the database.
    while($row = mysqli_fetch_array($r)){ # Checks each row to see if it has a dna sequence that matches our one ($dna).
      if($dna == $row[0]){
        return TRUE; # Return the boolean true if so.
      }
    }
    return FALSE; # If no match is found return false.
  }

  function checkNotes($notes){ # Allows for notes to be NULL to save database storage.
    if($notes == "Notes"){
      $notes = "NULL";
    }
    else{
      $notes = "'".$notes."'"; # SQL-friendly string.
    }
    return $notes;
  }
  # ===
?>
```

## js/accountScript.js

This contains JavaScript scripts that are used by the account page.

```javascript
function loadUserData(name, ea, admin){ // Displays the user's name, if they are an admin or not, and email address. It also displays a form for changing the password. Displays the sign out button aswell.
  document.getElementById("accountPageContent").innerHTML = '<form id="accountDetailsForm" action="index.php?page=account" method="post" class="greenYellow floatAesthetic"><p class="text">'+name+'<br><br>'+ea+'<br><br>'+admin+'</p><br><br><input name="passwordAE" type="password" value="Password" info="Password" onfocus="clearValue(this); selected(this);" onblur="restoreValue(this); deselected(this);"/><input name="passwordConAE" type="password" value="Password" info="Password" onfocus="clearValue(this); selected(this);" onblur="restoreValue(this); deselected(this);"/><input name="submitAE" type="submit" value="Submit"/><input name="submittedAE" type="hidden" value="TRUE"></type><br><div id="signOutBtn" class="button redBtn large" onclick="document.cookie = \'user=;expires=Thu, 01 Jan 1970 00:00:00 UTC\'; window.location.href=\'http://www.google.co.uk\';"><p>Sign out</p></div><br><br>';
}

function loadAccountPage(emailAddress){ // This displays the sign in and sign up forms that are processed by PHP when submitted.
  document.getElementById("accountPageContent").innerHTML = '<br><div id="con"><div id="signUpForm" class="redPurple floatAesthetic"><form action="index.php?page=account" method="post"><br><br><input name="firstNameSU" type="text" value="Rosalind" info="Rosalind" onfocus="clearValue(this); selected(this);" onblur="restoreValue(this); deselected(this);"/><input name="secondNameSU" type="text" value="Franklin" info="Franklin" onfocus="clearValue(this); selected(this);" onblur="restoreValue(this); deselected(this);"/><input name="emailAddressSU" type="email" value="rf@example.com" info="rf@example.com" onfocus="clearValue(this); selected(this);" onblur="restoreValue(this); deselected(this);"/><input id="passwordConSU" name="passwordConSU" type="password" value="Password" info="Password" onfocus="clearValue(this); selected(this);" onblur="restoreValue(this); deselected(this);"/><select name="interestSU"><option value="NULL">Interest</option><option value="Scientist">For science!</option><option value="Company">For a company</option><option value="Student">I\'m a student :)</option><option value="Curious">Just curious</option></select><input type="submit" value="Sign up" class="button"/><input name="submittedSU" type="hidden" value="TRUE"/></form></div><div id="signInForm" class="greenYellow floatAesthetic"><form action="./index.php?page=account" method="post"><br><input name="emailAddressSI" type="email" value="'+emailAddress+'" info="rf@example.com" onfocus="clearValue(this); selected(this);" onblur="restoreValue(this); deselected(this);"/><input name="passwordSI" type="password" value="Password" info="Password" onfocus="clearValue(this); selected(this);" onblur="restoreValue(this); deselected(this);"/><input type="submit" value="Sign in" class="button"/><input name="submittedSI" type="hidden" value="TRUE"/></form></div></div><br><br>';
}
```

## js/entryScript.js

This contain JavaScript code that is used by the entry page.

```javascript
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
```

## js/inputScript.js

This file contains JavaScript code that is used by HTML form inputs.

```javascript
function dnaInputCheck(element){ // Ensures inputted DNA character is valid.
  value = element.value[element.value.length-1];
  value = value.toUpperCase(); // Converts all values to be upper case, as text-transform: capitalise does not change the value of the input to be capitalised. Capital form allows for less variety in the potential values for 'value'.
  if (value !== "A" && value !== "G" && value !== "T" && value !== "C" && value !== "N") { // N is for unidentified bases.
    element.value = element.value.substr(0, element.value.length-1); // If the character is not valid then we remove it.
  }
}
// Functions for selecting and delecting an input.
  function selected(element){
    if(pauseSelect === false){ // Only works if night mode is not enabled.
      element.style.backgroundColor = "#EFEFEF";
    }
  }

  function deselected(element){
    if(pauseSelect === false){
      element.style.backgroundColor = "rgba(238, 238, 238, 0.7)";
    }
  }
 // Functions for removing and setting the default value for an input
  function clearValue(element){ // Called when the user is focusing on the input.
    if(element.value == element.getAttribute("info")){ // Checks if the value of input is the same as its default value, denoted buy the attribute 'info'.
      element.value = "";
    }
  }

  function restoreValue(element){ // Called when the user is not focusing on the input.
    if(element.value == ""){
      element.value = element.getAttribute("info"); // Resets the default value if not data has been inputted.
    }
  }
```

## js/menuScript.js

This JavaScript code is used for the menu sidebar that is found in the user interface.

```javascript
function menuBtnClick(value) { // Used to switch between pages. value represents the page the user has clicked on.
  document.getElementById("homePage").style.opacity = '0'; // Prevents the homePage from popping up everytime index.php loads to create a more seamless transition.
  postEle = document.getElementsByClassName("postBtn");
  if((value === "forum" || value === "forumSingleView") && document.cookie.substring(document.cookie.indexOf("user"), document.cookie.indexOf("user")+4) === "user"){ // If the user is logged in and one of the forumpages are being accessed.
    for(i=0;i < postEle.length; i++){
      postEle[i].style.display = "block"; // Display all post-related menu elements.
    }
  }
  else { // If any other page is being switched to.
    for(i=0;i < postEle.length; i++){
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
  page = document.getElementById(value).style; // Get the style attributes of the page we are trying to switch to.
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
```

## js/toolScript.js

This javaScript code is by the tool page.

```javascript
function addHmod(name, id, display = "hmodSequence", list = "histoneModsT"){
  // Defaults for output: display is where the list of mods is shown to the user. list is the actual list of ids that we will use in processing.
  document.getElementById(display).innerHTML += String(name)+" "; // Add the histone modification name to the display div.
  document.getElementById(list).value += String(id)+","; // Append the id of the histone modification tothe hidden input list.
}

function removeLastHmod(display = "hmodSequence", list = "histoneModsT"){
  text = document.getElementById(display);
  list = document.getElementById(list);
  mods = text.innerHTML.split(" "); // Splits up all of the dsiplay mod names.
  ids = list.value.split(","); // Splits up the list of ids.
  mods.splice(mods.lengths-1, 1); // Removes the last name from the display.
  ids.splice(ids.lengths-1, 1); // Removes the last id from the list.
  final = "";
  for(i=0;i<mods.length;i++){
    final += String(mods[i])+" "; // Append each mod name with a space at the end to create the name name display.
  }
  text.innerHTML = final; // Set the HTML content of the display to the new sequence of mod names.
  list.value = String(ids);
}

function split(display = "hmodSequence", list = "histoneModsT"){ // | Signifies the end of one nucleosome and the beginning of another.
  text = document.getElementById(display);
  list = document.getElementById(list);
  text.innerHTML += " | ";
  list.value += "|";
}
```