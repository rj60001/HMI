<?php
  $trim = array_map('trim', $_POST);
  if(isset($_COOKIE["user"])){
    require_once("forum.php");
    require_once("tool.php");
    require_once("search.php");
  }
  require_once("account.php");
?>
