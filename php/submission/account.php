<?php
  $trim = array_map('trim', $_POST);
  if(isset($trim["submittedSU"])){
    $fn = $trim["firstNameSU"];
    $sn = $trim["secondNameSU"];
    $ea = $trim["emailAddressSU"];
    $pw = $trim["passwordSU"];
    $in = $trim["interestSU"];

    $q = "INSERT INTO users VALUES(NULL, $fn, $sn, $ea, crypt($pw, 'iN5@n1tY'), $in)";
    $r = mysqli_query($db, $q);
    echo($popupTop);
    #echo();
    echo($popupBottom);
  }
?>
