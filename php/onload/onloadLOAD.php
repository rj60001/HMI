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
