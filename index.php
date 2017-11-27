<html>
  <?php
    $db = mysqli_connect("localhost", "root", "", "hmi");
    $uid = "";
    $userRow = [];
    if(isset($_COOKIE["user"])){
      $uid = $_COOKIE["user"];
      $userRow = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM users WHERE uid=".$uid));
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
    <link href="https://fonts.googleapis.com/css?family=Comfortaa|Megrim" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/menuStyles.css">
    <link rel="stylesheet" href="css/inputStyles.css">
    <link rel="stylesheet" href="css/mediaStyles.css">
    <link rel="stylesheet" href="css/popupStyles.css">
    <link rel="stylesheet" href="css/forumStyles.css">
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
        <p onclick="menuBtnClick('tool');"><i id="toolBtn" class="material-icons" onclick="menuBtnClick('tool');">build</i></p>
        <p onclick="menuBtnClick('news');"><i class="material-icons">announcement</i></p>
        <p onclick="menuBtnClick('about');"><i class="material-icons">help</i></p>
        <p  onclick="menuBtnClick('forum');"><i id="forumBtn" class="material-icons">subject</i></p>
        <hr class="menuRule postBtn">
        <p id="forumPostMenuBtn" class="postBtn" onclick="displayPU('postingPU');"><i class="material-icons">create</i></p>
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
          <?php
            if(isset($_COOKIE["user"])){
              echo('<p name="subTitle" class="subTitle">TOOL</p>
                    <p class="text">This is the main tool page. Here you can add or pull data from the database on any DNA sequence, by completing the form that follows:</p>
                    <br>
                    <br>
                    <form action="index.php?page=tool" method="post">
                      <input id="searchInput" name="searchInput" type="text" value="Search" info="Search" onfocus="clearValue(this);" onblur="restoreValue(this);"/>
                      <input name="searchSubmitted" type="hidden" value="TRUE"/>
                    </form>
                    <hr>
                    <br>
                    <form>
                      <p class="text">Here you can create your own DNA sequence and histone modification sequence. Note that the tool is still in beta - there is <b>no</b> histone code checking.</p>
                      <input name="submitT" type="submit" value="Query" class="button extender"/>
                      <input name="submittedT" type="hidden" value="TRUE"/>
                    </form>');
            }
          ?>
        </div>
      </div>
      <div id="newsPage" class="page">
        <p name="title" class="Title">Nomios</p>
        <div class="textCon">
          <p name="subTitle" class="subTitle">NEWS</p>
          <p class="text"></p>
        </div>
      </div>
      <div id="aboutPage" class="page">
        <p name="title" class="title">Nomios</p>
        <div class="textCon">
          <p name="subTitle" class="subTitle">ABOUT</p>
          <p class="text"></p>
        </div>
      </div>
      <div id="forumPage" class="page">
        <p name="title" class="title">Nomios</p>
        <div class="textCon">
          <p name="subTitle" class="subTitle">FORUM</p>
          <div id="forumPageContent">
            </div>
          </div>
        </div>
        <div id="forumSingleViewPage" class="page">
        <p name="title" class="title">Nomios</p>
        <div class="textCon">
          <p name="subTitle" class="subTitle">FORUM</p>
          <div id="forumSingleViewPageContent">
            <?php
              function convert($m) { //Converts artificial mark-up to HTML.
                $chars = ['[i]', '[/i]', '[b]', '[/b]', '[l]', '[/l]'];
                $replaceChars = ['<em>', '</em>', '<b>', '</b>', '<ul>', '</ul>'];
                for($i=0;$i<count($chars);$i++){
                  $m = str_replace($chars[$i], $replaceChars[$i], $m);
                }
                return $m;
              }

              if(isset($_GET["thread"]) && isset($_COOKIE["user"])){
		            echo("<script>menuBtnClick('forumSingleView');</script>");
		            $tid = $_GET["thread"];
		            $r = mysqli_query($db, "SELECT subject, message, firstName FROM thread INNER JOIN users ON thread.uid = users.uid WHERE tid=".$tid);
		            $rowT = mysqli_fetch_array($r);
                $m = convert($rowT[1]);
		            echo("<br><br><div class='forumObj OP'><div class='forumCon'><b>$rowT[0]</b><br>$m<br><em class='forumNameTag'>$rowT[2]</em></div></div>");
		            $r = mysqli_query($db, "SELECT message, firstName FROM message INNER JOIN users ON message.uid = users.uid WHERE tid=".$tid);
		            while($row = mysqli_fetch_array($r)){
                  $m = convert($row[0]);
			            echo("<br><div class='forumObj'><div class='forumCon'>$m<br><em class='forumNameTag'>$row[1]</em></div></div>");
		            }
	            }
            ?>
            </div>
          </div>
        </div>
      </div>
      <div id="accountPage" class="page">
        <p name="title" class="title">Nomios</p>
        <div class="textCon">
          <p name="subTitle" class="subTitle">ACCOUNT</p>
          <div id="accountPageContent">
          </div>
        </div>
      </div>
      <?php
        $popupTop = '<div class="boardConPU"><div class="mainConPU"><div class="textConPU"><p class="titlePU">Notification<span class="crossPU">X</span></p>';
        $altPopupTop = substr($popupTop, 0, 23).' style="display: none" id="postingPU">'.substr($popupTop, 24);
        $popupBottom = '</div></div></div>';
        include("php/onload/onloadLOAD.php");
        include("php/submission/submissionLOAD.php");
        #Tags that need to be loaded on start bu require PHP.
        if(isset($_COOKIE["user"])){
          if(isset($_GET["thread"])){
              echo($altPopupTop.'<br>Post A Reply<br><br><form action="index.php?page=forum&thread='.$_GET["thread"].'" method="post"><textarea name="messagePM" class="textareaPU" info="Message" onfocus="clearValue(this);" onblur="restoreValue(this);">Message</textarea><br><br><input name="submittedPM" type="submit" class="button btnPU"/></form>'.$popupBottom);
          }
          else {
              echo($altPopupTop.'<br>Start A Thread<br><br><form action="index.php?page=forum" method="post"><textarea class="textareaPU subjectTextareaPU" name="subjectPT" info="Subject" onfocus="clearValue(this);" onblur="restoreValue(this);">Subject</textarea><br><br><textarea name="messagePT" class="textareaPU" info="Message" onfocus="clearValue(this);" onblur="restoreValue(this);">Message</textarea><br><br><input name="submittedPT" type="submit" class="button btnPU"/></form>'.$popupBottom);
          }
        }
      ?>
      </div>
   </body>
</html>
