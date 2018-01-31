<?php
  if(isset($_GET["hash"])){ // If the user is activating their account
    $hash = $_GET["hash"]; // Get the hash from the URL query
    $ea = $_GET["email"];
    $q = "UPDATE users SET hash = NULL WHERE emailAddress='$ea' AND hash='$hash'"; // Set the hash to NULL so that the user can log in.
    $r = mysqli_query($db, $q); // Processes the query $q and returns the result.
    if($r){ // If the result actually returns a result.
      echo($popupTop);
      echo("<p>You can now sign in.</p>");
      echo($popupBottom);
      // Display a notification letting them know that activation was successfull to the user.
    }
  }
  else { // User cannot activate their account and be signed in at the same time.
    $emailAddress = isset($trim["emailAddressSI"]) ? $trim["emailAddressSI"] : "rf@example.com"; # If the user has tried to sign in, save the inputted email address so that they can correct their mistakes.
    # w = x ? y : z ; Means w is set to y if x is true. If x is false set w to z.
    if(isset($_COOKIE["user"])){ // If the user is signed in.
      $q = "SELECT * FROM users WHERE uid=".$_COOKIE['user'];
      $r = mysqli_query($db, $q);
      $num = mysqli_num_rows($r); // Get the number of returned rows.
      if($num == 1){ // If user account is returned (each user row is unqiue so it must be equal to 1).
        $name = ($userRow[1]." ".$userRow[2]); // Get the name.
        $ea = $userRow[3]; // Get the email address.
        $a = 'Standard account'; // Initialise the admin string variable.
        if($admin == TRUE){ // If the user is an admin
          $a = 'Admin account';
        }
        echo('<script>loadUserData("'.$name.'", "'.$ea.'", "'.$a.'");</script>'); // Display the user account data and password form.
      }
      else if($num != 1) { // If the account is not unqiue, must be malicous. Or if it does not exist we need to display the correct account page.
        echo('<script>document.cookie = "user=;expires='.(time()-100).'"; document.getElementById("accountPage").innerHTML = \''.$accountMenu.'\';</script>'); # Delete user cookie if user not found in database.
        echo('<script>loadAccountPage('.$emailAddress.');</script>'); # Display the sign in and sign up forum
      }
      else {
        echo('<script>loadAccountPage("'.$emailAddress.'");</script>');
      }
    }
    else {
      echo('<script>loadAccountPage("'.$emailAddress.'");</script>');
    }
  }
?>
