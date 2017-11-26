<?php
  if(isset($_GET["hash"])){
    $hash = $_GET["hash"];
    $ea = $_GET["email"];
    $q = "UPDATE users SET hash = NULL WHERE emailAddress='$ea' AND hash='$hash'";
    $r = mysqli_query($db, $q);
    if($r){
      echo($popupTop);
      echo("<p>You can now sign in.</p>");
      echo($popupBottom);
    }
  }
  else {
    if(isset($_COOKIE["user"])){
      $q = "SELECT * FROM users WHERE uid=".$_COOKIE['user'];
      $r = mysqli_query($db, $q);
      $num = mysqli_num_rows($r);
      if($num == 1){
        $name = ($userRow[1]." ".$userRow[2]);
        $ea = $userRow[3];
        echo('<script>loadUserData("'.$name.'", "'.$ea.'");</script>');
      }
      else if($num =! 1) {
        echo('<script>document.cookie = "user=;expires='.(time()-100).'"; document.getElementById("accountPage").innerHTML = \''.$accountMenu.'\';</script>'); #Delete user cookie if user not found in database.
        echo('<script>loadAccountPage();</script>');
      }
      else {
        echo('<script>loadAccountPage();</script>');
      }
    }
    else {
      echo('<script>loadAccountPage();</script>');
    }
  }
?>