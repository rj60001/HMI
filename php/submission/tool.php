<?php
  if(isset($trim["submittedD"])){
    $name = strip_tags($trim["diseaseNameD"]);
    $errors = [];
    if($name == "Disease name"){
      $errors = ["Name cannot be default value"];
    }
    else { # This checks to see if the disease is already in the database. One or the other as 'Disease Name' cannot be submitted as a value so it wont be in the database.
      $r = mysqli_query($db, "SELECT name FROM disease"); # Selects all of the name in the disease table.
      while($row = mysqli_fetch_array($r)){ # For each row in the table.
        if($row[0] == $name){ # Checks if the user-inputted name is the same as the current row.
          $errors = ["Disease already in the database"];
        }
      }
    }

    if(empty($errors)){
      $q = "INSERT INTO disease VALUES(NULL, '".$name."')";
      $r = mysqli_query($db, $q);
      echo("<script>window.location.href = 'index.php?page=tool&diseaseSubmitted=TRUE';</script>");
    }
    else {
      echo($popupTop);
      foreach($errors as $error){
        echo('<p>'.$error.'</p>');
      }
      echo($popupBottom);
    }
  }
  if(isset($trim["submittedT"])){ # This is for submitting a new sequence.
    $dnaStr = $trim["dnaSequenceT"];
    $modsStr = $trim["histoneModsT"]; # ."|"Allows us to extract the last histone in the list.
    $name = strip_tags($trim["sequenceNameT"]);
    $diseaseAssoc = $trim["diseaseAssociationT"];
    $errors = [];
    if($modsStr == "" || $dnaStr == "ATCG" || $name == "Name"){
      $errors = ["Cannot use default values."];
    }
    $r = mysqli_query($db, "SELECT name FROM nucelosomesequence WHERE uid=$uid");
    do { # This lets us break out of the do-while and use the below error script if an error occurs.
      while($row = mysqli_fetch_array($r)){
        if($row[0] == $name){
          $errors = ["You already have a sequence with that name."];
          break;
        }
      }
      $dnaStrs = str_split($dnaStr, 127); # Produces nucleosome-sized chunks of DNA.
      $modsStrs = explode("|", $modsStr); # Produces a specified chunk of histone modifications for each specified nucleosome.
      $did = "";
      if($diseaseAssoc != "NULL"){
        $did = (int)$diseaseAssoc;
      }
      else {
        $did = "NULL";
      }
      echo $popupTop.$did.$popupBottom;
      if(count($dnaStrs) != count($modsStrs)){
        for($i=0;$i<abs(count($dnaStrs) - count($modsStrs));$i++){ # DIfference between the two values (abs() returns the magnitude of a number).
          array_push($modsStrs, " ");
        }
      }
      $queries = []; # Array that holds all of our nucleosome queries ONLY.
      $r = mysqli_query($db, "INSERT INTO nucelosomesequence VALUES(NULL, $uid, $did, '".$name."')"); # Inserts the nucleosome sequence into its table.
      $nsid = mysqli_fetch_array(mysqli_query($db, "SELECT nsid FROM nucelosomesequence WHERE uid=$uid AND name='".$name."'"))[0]; # Fetches the ID of this new record.
      for($i=0;$i<count($dnaStrs);$i++){
        $dna = $dnaStrs[$i]; # Current DNA.
        $mods = $modsStrs[$i]; # Current histone mods.
        $ndsid = -1;
        $dnaFound = 0;
        $r = mysqli_query($db, "SELECT * FROM nucleosomednasequence");
        while($row = mysqli_fetch_array($r)){
          if($row[1] == $dna){ # If the DNA sequence is matching.
            $ndsid = $row[0]; # Get the id of this sequence.
            $dnaFound = 1;
          }
        }
        if($dnaFound != 1){
          $r = mysqli_query($db, "INSERT INTO nucleosomednasequence VALUES(NULL, '".$dna."')");
          $ndsid = mysqli_fetch_array(mysqli_query($db, "SELECT ndsid FROM nucleosomednasequence WHERE DNASequence='".$dna."'"))[0]; # Fetches the id of the dna sequence we just inserted.
        }
        array_push($queries, "INSERT INTO nucleosome VALUES(NULL, $ndsid, '".$mods."', $nsid)"); # Adds the nucleosome to its table.
      }
      foreach($queries as $query){
        $r = mysqli_query($db, $query);
      }
      echo($popupTop."<p>Your sequence has now been submitted. Navigate to your sequences to view its results.</p>".$popupBottom);
      break;
    } while (empty($errors));

    if(!empty($errors)) {
      echo($popupTop);
      foreach($errors as $error){
        echo('<p>'.$error.'</p>');
      }
      echo($popupBottom);
    }
  }
?>
