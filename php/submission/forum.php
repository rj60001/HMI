<?php
  if(isset($trim["deleteMid"])){
    $r = mysqli_query($db, "DELETE FROM message WHERE mid=".$trim['deleteMid']);
    $r = mysqli_query($db, "DELETE FROM replies WHERE mid=".$trim['deleteMid']);
    echo('<script>window.location.href = "index.php?'.$_SERVER['QUERY_STRING'].'";</script>');
  }
  else if(isset($trim["deleteTid"])){
    $r = mysqli_query($db, "DELETE FROM thread WHERE tid=".$trim['deleteTid']);
    $r = mysqli_query($db, "DELETE FROM message WHERE tid=".$trim['deleteTid']);
    echo('<script>window.location.href = "index.php?'.$_SERVER['QUERY_STRING'].'";</script>');
  }
  else if(isset($trim["deleteRid"])){
    $r = mysqli_query($db, "DELETE FROM replies WHERE Rid=".$trim['deleteRid']);
    echo('<script>window.location.href = "index.php?'.$_SERVER['QUERY_STRING'].'";</script>');
  }

  if(isset($trim["submittedPT"])){
    $s = strip_tags($trim["subjectPT"]);
    $m = strip_tags($trim["messagePT"]);
    $errors = [];
    if($s == "Subject" || $m == "Message"){
      $errors = ["Cannot post default values."];
    }
    if(empty($errors)){
      $q = "INSERT INTO thread VALUES(0, $uid, '$s', '$m')";
      $r = mysqli_query($db, $q);
      echo('<script>window.location.href = "index.php?page=forum&threadSubmitted=1";</script>');
    }
    else {
      echo($popupTop);
      foreach($errors as $error){
        echo("<p>".$error."</p>");
      }
      echo($popupBottom);
    }
  }
  else if(isset($trim["submittedPM"])){
    $m = strip_tags($trim["messagePM"]);
    $tid = $_GET["thread"];
    $errors = [];
    if($m == "Message"){
      $errors = ["Cannot post a default value."];
    }

    if(empty($errors)){
      $r = mysqli_query($db, "INSERT INTO message VALUES(0, $tid, $uid, '$m')");
      echo('<script>window.location.href = "index.php?page=forum&thread='.$tid.'";</script>');
    }
    else {
      echo($popupTop);
      foreach($errors as $error){
        echo("<p>".$error."</p>");
      }
      echo($popupBottom);
    }
  }
  else if(isset($trim["midPR"])){
    $m = strip_tags($trim["messagePR"]);
    $tid = $_GET["thread"];
    $errors = [];
    if($m == "Message"){
      $errors = ["Cannot post a default value."];
    }

    if(empty($errors)){
      $r = mysqli_query($db, "INSERT INTO replies VALUES(0, ".$trim['midPR'].", $uid, '$m')");
      echo('<script>window.location.href = "index.php?page=forum&thread='.$tid.'";</script>');
    }
    else {
      echo($popupTop);
      foreach($errors as $error){
        echo("<p>".$error."</p>");
      }
      echo($popupBottom);
    }
  }

  if(isset($_GET["threadSubmitted"])){
    $tid = mysqli_fetch_array(mysqli_query($db, "SELECT tid FROM thread ORDER BY uid DESC LIMIT 1"))[0];
    echo('<script>window.location.href = "index.php?page=forum&thread='.$tid.'";</script>');
  }
?>
