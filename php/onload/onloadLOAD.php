<?php
  include("account.php");
  if(isset($_COOKIE["user"])){
    require_once("forum.php");
  }
  echo("<script>");
  if(isset($_GET["page"]) && isset($_COOKIE["user"])){
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
      case "search":
        echo("menuBtnClick('search');");
        break;
      default:
        echo("menuBtnClick('home');");
        break;
    }
  }
  else {
    echo("menuBtnClick('home');");
  }
  echo("</script>");
?>
