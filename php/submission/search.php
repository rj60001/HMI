<?php
  if(isset($trim["searchValue"]) && isset($trim["searchType"])){
    $sv = $trim["searchValue"];
    $st = $trim["searchType"];
    $errors = [];
    if($sv == "Search"){
      $errors = ["Cannot use default value."];
    }

    if(empty($errors)){
      if($st == "none"){ /*This means both forum, disease and sequences records are searched through.*/

      }
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
