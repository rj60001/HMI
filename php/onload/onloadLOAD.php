<?php
  include("account.php");
  if(isset($_COOKIE["user"])){
    require_once("forum.php");
  }
  if(isset($_GET["page"])){
    echo('<script>enterBtn = document.getElementById("enterBtn");
                  bgObjs = document.getElementsByName("bgObj");
                  bgObjCon = document.getElementById("bgObjCon");
                  menu = document.getElementById("mainCon");
                  body = document.getElementsByTagName("BODY")[0];
                  menuPopUp(enterBtn, bgObjs, bgObjCon, menu, body);');
    switch($_GET["page"]){
      case "account":
        echo("menuBtnClick('account');");
        break;
      case "forum":
        if(isset($_GET["thread"])){
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
        echo("menuBtnClick('tool');");
        break;
    }
    echo("</script>");
  }
?>
