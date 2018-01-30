<?php
  require_once("account.php"); # Require_once makes sure that only one version of the file is included and prevents the execution of the rest of this script if it is not present - preventing a user from running an errornous version of this program.
  if(isset($_COOKIE["user"])){
    require_once("forum.php");
    require_once("tool.php");
    require_once("toolSingleView.php");
    require_once("search.php");
  }
  echo("<script>");
  if(isset($_GET["page"]) && isset($_COOKIE["user"])){
    if(isset($_COOKIE["uid"])){
      switch($_GET["page"]){
        case "account":
          echo("menuBtnClick('account');");
          break;
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
        default:
          echo("menuBtnClick('home');");
          break;
      }
    }
    else if($_GET["page"] == "account"){
      echo("menuBtnClick('account');");
    }
    else {
      echo("menuBtnClick('home');");
    }
  }
  echo("</script>");
?>
