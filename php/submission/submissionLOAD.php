<?php
  $trim = array_map('trim', $_POST);
  if(isset($_COOKIE["user"])){ # Pages for signed in users only
    require_once("forum.php");
    require_once("tool.php");
    require_once("search.php");
    require_once("toolSingleView.php");
  }
  require_once("account.php"); # The page that anyone can access.
?>
