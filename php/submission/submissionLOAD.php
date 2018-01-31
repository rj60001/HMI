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
