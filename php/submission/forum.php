<?php
  # Deleting forum items
  if(isset($trim["deleteMid"])){
    # $trim["deleteMid"] holds the ID for the message.
    $r = mysqli_query($db, "DELETE FROM message WHERE mid=".$trim['deleteMid']); # Delete the message we want to delete.
    $r = mysqli_query($db, "DELETE FROM replies WHERE mid=".$trim['deleteMid']); # Delete all attached replies to that message.
    echo('<script>window.location.href = "index.php?'.$_SERVER['QUERY_STRING'].'";</script>'); # Redirected to the same thread on the forum single view page.
  }
  else if(isset($trim["deleteTid"])){ # Delete an entire thread.
    $r = mysqli_query($db, "DELETE FROM thread WHERE tid=".$trim['deleteTid']); # Delete the thread.
    $r = mysqli_query($db, "SELECT mid FROM message WHERE tid=".$trim['deleteTid']); # Select all messages in this thread.
    while($row = mysqli_fetch_array($r)){ # For each message
      $mid = $row[0]; # Fetch the message ID for deleting the replies associated with each message because the replies do not contain a tid column.
      $r = mysqli_query($db, "DELETE FROM message WHERE mid=".$mid); # Delete the message using this ID.
      $r = mysqli_query($db, "DELETE FROM replies WHERE mid=".$mid); # Delete replies associated with this message.
    }
    echo('<script>window.location.href = "index.php?page=forum";</script>'); # Redirect to the forum to view all threads.
  }
  else if(isset($trim["deleteRid"])){ # Delete a reply.
    $r = mysqli_query($db, "DELETE FROM replies WHERE rid=".$trim['deleteRid']);
    echo('<script>window.location.href = "index.php?'.$_SERVER['QUERY_STRING'].'";</script>'); # Redirected to the same thread on the forum single view page.
  }
  # ===

  if(isset($trim["submittedPT"])){ # If the user is posting a new thread.
    $s = strip_tags($trim["subjectPT"]);
    $m = strip_tags($trim["messagePT"]);
    $errors = [];
    if($s == "Subject" || $m == "Message"){
      $errors = ["Cannot post default values."];
    }
    if(empty($errors)){ # If there are no errors.
      $q = "INSERT INTO thread VALUES(0, $uid, '$s', '$m', CURRENT_TIMESTAMP)"; # Add a new row to the thread table. CURRENT_TIMESTAMP gets the current time and date of the server.
      $r = mysqli_query($db, $q);
      $tid  = mysqli_fetch_array(mysqli_query($db, "SELECT tid FROM thread ORDER BY tid DESC LIMIT 1"))[0]; # Fetch the ID of the latest thread and therefore, the one we just submitted.
      echo('<script>window.location.href = "index.php?page=forum&thread='.$tid.'";</script>'); # Redirect to the singleViewPage to view on this particular thread.
    }
    else {
      echo($popupTop);
      foreach($errors as $error){
        echo("<p>".$error."</p>");
      }
      echo($popupBottom);
    }
  }
  else if(isset($trim["submittedPM"])){ # If the user is posting a message to a thread.
    $m = strip_tags($trim["messagePM"]);
    $tid = $_GET["thread"]; # Get the id of the thread we are currently viewing (must be viewing a thread on a singleViewPage to post a message to it).
    $errors = [];
    if($m == "Message"){
      $errors = ["Cannot post a default value."];
    }

    if(empty($errors)){
      $r = mysqli_query($db, "INSERT INTO message VALUES(0, $tid, $uid, '$m', CURRENT_TIMESTAMP)"); # Insert a new row to the message table.
      echo('<script>window.location.href = "index.php?page=forum&thread='.$tid.'";</script>');# Reload the page to prevent resubmission.
    }
    else {
      echo($popupTop);
      foreach($errors as $error){
        echo("<p>".$error."</p>");
      }
      echo($popupBottom);
    }
  }
  else if(isset($trim["midPR"])){ # If the user is posting a reply to a message.
    $m = strip_tags($trim["messagePR"]);
    $tid = $_GET["thread"];
    $errors = [];
    if($m == "Message"){
      $errors = ["Cannot post a default value."];
    }

    if(empty($errors)){
      echo('<script>window.location.href = "index.php?page=forum&thread='.$tid.'";</script>'); # Reload the page to prevent resubmission.
      $r = mysqli_query($db, "INSERT INTO replies VALUES(NULL, ".$trim['midPR'].", $uid, '$m', CURRENT_TIMESTAMP)"); # Insert a new row to the replies table.
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
