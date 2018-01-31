<?php
  if(isset($trim["submittedSU"])){ # If the user wants to sign up a new account.
    $fn = strip_tags($trim["firstNameSU"]); # Strip tags removes any HTMl tags, preventing XSS attacks. $trim is where all posted data is located.
    $sn = strip_tags($trim["secondNameSU"]); # We use names of inputs to extract data specific to a given input. Eg, $trim["x"] extracts data from the input with name x.
    $ea = strip_tags($trim["emailAddressSU"]);
    $pw = $trim["passwordConSU"];
    $in = $trim["interestSU"];
    $hash = md5($pw); # md5 is a hash algorithm that always produces a 32 character string.
    $errors = [];
    if(mysqli_num_rows(mysqli_query($db, "SELECT * FROM users WHERE emailAddress='$ea'")) > 0){ # If the email address submitted is not unqiue.
      $errors = ["Email addresss already in use."]; # Throw an error.
    }

    if($pw == "Password"){
      $errors = ["Password cannot be default."];
    }

    if($in == "Interest"){
      $errors = ["Please select and interest."];
    }

    if(empty($errors)){ # If the array contaisn no errors.
      $q = "INSERT INTO users VALUES(NULL, '$fn', '$sn', '$ea', '".crypt($pw, 'iN5@n1tY')."', '$in', '$hash', 0)"; # Create a new account, that is unactivated as it contains a hash value.
      # In the above line, crypt() is a hash algorithm that uses a salt to encrypt the password.
      $r = mysqli_query($db, $q);
      mail($ea, "Nomios - Please Confirm Your Account", "Confirm your account by clicking copy and pasting the following url: http://127.0.0.1/index.php?page=account&email=$ea&hash=$hash", "FROM: reiss1999@gmail.com");
      # Above line sends and email to the user's address.
      echo($popupTop);
      echo("<p>Take a look at your inbox for a confirmation before you sign in.</p>");
      echo($popupBottom);
      # Above three lines indicate to the user that they must activate their account.
    }
    else { # If there are errors, display them to the user so that they can correct them.
      echo($popupTop);
      foreach($errors as $error){
        echo("<p>".$error."</p>");
      }
      echo($popupBottom);
    }
  }
  else if(isset($trim["submittedSI"])){ # If the user is trying to sign in.
    $ea = $trim["emailAddressSI"];
    $pw = $trim["passwordSI"];
    $q = "SELECT uid FROM users WHERE emailAddress='$ea' AND password='".crypt($pw, 'iN5@n1tY')."'"; # Attempt to fetch the uid of a user that mathces the mail address and encrypted password entered.
    $r = mysqli_query($db, $q);
    if(mysqli_num_rows($r) == 1){ # If there is a one, unique result then it means that the account exists and is valid (a valid account is one where only one copy of it exists because malicous attakcs could bemade through duplicate accounts).
      if(mysqli_num_rows(mysqli_query($db, "SELECT uid FROM users WHERE emailAddress='$ea' AND hash IS NULL")) == 1){ # If the user's account ahs been activated.
        echo('<script>document.cookie = "user='.mysqli_fetch_array($r)[0].';expires='.(time()+(3600*24)*30).'"; reload();</script>'); # Create a cookie storing the user ID using JavaScript and refresh the page to prevent form resubmission.
      }
      else { # Otherwise, the user's account is not activated.
        echo($popupTop);
        echo("<p>The account has not yet been confirmed. Please check your inbox.</p>");
        echo($popupBottom);
      }
    }
    else { # No account mathces the encrypted-password and email address combination.
      echo($popupTop);
      echo("<p>Either the account does not exist or the password was incorrect.</p>");
      echo($popupBottom);
    }
  }
  else if(isset($trim["submittedAE"])){ # If the user is editing their password
    $pw = $trim["passwordAE"];
    $pc = $trim["passwordConAE"]; # Password confirmation
    $pwc = crypt($pw, 'iN5@n1tY'); # Encrypt the password
    $errors = [];
    if($pw !== $pc){ # !== not same type or same value.
      $errors = ["Passwords do not match."];
    }

    if($pw == "Password" || $pwc == "password" || $pwc == mysqli_fetch_array(mysqli_query($db, "SELECT password FROM users WHERE uid = ".$_COOKIE["user"][0]))){
      # If the password has already been entered or it was left at its default value throw an error. Don't need to check $pw to see if it matches the already entered password as if it mathces $pwc, then $pwc will throw an error for it.
      $errors = ["Password is invalid."];
    }

    if(empty($errors)){ # If no errors are found.
      $q = "UPDATE users SET password = '".$pwc."' WHERE uid = ".$_COOKIE["user"];
      $r = mysqli_query($db, $q); # Update the password.
      echo($popupTop);
      echo("<p>Password updated.</p>");
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
