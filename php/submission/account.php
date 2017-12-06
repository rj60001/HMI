<?php
  if(isset($trim["submittedSU"])){
    $fn = strip_tags($trim["firstNameSU"]);
    $sn = strip_tags($trim["secondNameSU"]);
    $ea = strip_tags($trim["emailAddressSU"]);
    $pw = $trim["passwordConSU"];
    $in = $trim["interestSU"];
    $hash = md5($pw);
    $errors = [];
    if(mysqli_num_rows(mysqli_query($db, "SELECT * FROM users WHERE emailAddress='$ea'")) > 0){
      $errors = ["Email addresss already in use."];
    }

    if($pw == "Password"){
      $errors = ["Password cannot be default."];
    }

    if($in == "Interest"){
      $errors = ["Please select and interest."];
    }

    if(empty($errors)){
      $q = "INSERT INTO users VALUES(NULL, '$fn', '$sn', '$ea', '".crypt($pw, 'iN5@n1tY')."', '$in', '$hash', 0)";
      $r = mysqli_query($db, $q);
      mail($ea, "Nomios - Please Confirm Your Account", "Confirm your account by clicking http://www.netballmanager.co.uk/hmi/index.php?page=account&email=$ea&hash=$hash", "FROM: reiss1999@gmail.com");
      echo($popupTop);
      echo("<p>Take a look at your inbox for a confirmation before you sign in.</p>");
      echo($popupBottom);
    }
    else {
      echo($popupTop);
      foreach($errors as $error){
        echo("<p>".$error."</p>");
      }
      echo($popupBottom);
    }
  }
  else if(isset($trim["submittedSI"])){
    $ea = $trim["emailAddressSI"];
    $pw = $trim["passwordSI"];
    $q = "SELECT uid FROM users WHERE emailAddress='$ea' AND password='".crypt($pw, 'iN5@n1tY')."'";
    $r = mysqli_query($db, $q);
    if(mysqli_num_rows($r) == 1){
      if(mysqli_query($db, "SELECT uid FROM users WHERE emailAddress='$ea' AND hash IS NULL")){
        echo('<script>document.cookie = "user='.mysqli_fetch_array($r)[0].';expires='.(time()+(3600*24)*30).'"; reload();</script>');
      }
      else {
        echo($popupTop);
        echo("<p>The account has not yet been confirmed. Please check your inbox.</p>");
        echo($popupBottom);
      }
    }
    else {
      echo($popupTop);
      echo("<p>Either the account does not exist or the password was incorrect.</p>");
      echo($popupBottom);
    }
  }
  else if(isset($trim["submittedAE"])){
    $pw = $trim["passwordAE"];
    $pc = $trim["passwordConAE"];
    $pwc = crypt($pw, 'iN5@n1tY');
    $errors = [];
    if($pw !== $pc){
      $errors = ["Passwords do not match."];
    }

    if($pw == "Password" || $pwc == mysqli_fetch_array(mysqli_query($db, "SELECT password FROM users WHERE uid = ".$_COOKIE["user"][0]))){
      $errors = ["Password is invalid."];
    }

    if(empty($errors)){
      $q = "UPDATE users SET password = '".$pwc."' WHERE uid = ".$_COOKIE["user"];
      $r = mysqli_query($db, $q);
      echo($popupTop);
      echo("<p>Record updated.</p>");
      echo($popupBottom);
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
