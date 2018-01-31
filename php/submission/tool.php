<?php
  if(isset($trim["submittedD"])){
    $name = strip_tags($trim["diseaseNameD"]);
    $notes = checkNotes(strip_tags($trim["notesD"])); # Sets notes to be SQL compliant by encapsulating them with quotation marks if not default value and if a default value set it to be NULL.
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
      $q = "INSERT INTO disease VALUES(NULL, '$name', $notes, $uid)"; # Insert a new row into the disease table.
      $r = mysqli_query($db, $q);
      echo("<script>window.location.href = 'index.php?page=search&diseaseSubmitted=TRUE';</script>"); # Reload the page to prevent resubmission.
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
    $dnaStr = strtoupper($trim["dnaSequenceT"]); # Convert text to be capitalised (it is not changed by CSS).
    $modsStr = $trim["histoneModsT"];
    $name = strip_tags($trim["sequenceNameT"]);
    $notes = checkNotes(strip_tags($trim["notesT"]));
    $diseaseAssoc = $trim["diseaseAssociationT"];
    $errors = [];
    if($modsStr == "" || $dnaStr == "ATCG" || $name == "Name"){
      $errors = ["Cannot use default values."];
    }
    $r = mysqli_query($db, "SELECT name FROM nucelosomesequence WHERE uid=$uid"); # Select the names from all nucleosomesequences.
    while($row = mysqli_fetch_array($r)){ # For each returned row
      if($row[0] == $name){ # Check if the name matches with name of a sequence that the user already owns.
        $errors = ["You already have a sequence with that name."];
        break;
      }
    }
    if(empty($errors)){
      $dnaStrs = str_split($dnaStr, 127); # Produces nucleosome-sized chunks of DNA.
      $modsStrs = explode("|", $modsStr); # Produces a chunk of histone modifications for each specified nucleosome.
      $did = "";
      if($diseaseAssoc != "NULL"){
        $did = (int)$diseaseAssoc; # Cast the string value of the disease association as an integer.
      }
      else {
        $did = "NULL";
      }
      if(count($dnaStrs) > count($modsStrs)){ # If we have more DNA chunks than histone modifications
        for($i=0;$i<abs(count($dnaStrs) - count($modsStrs));$i++){ # Difference between the two values (abs() returns the magnitude of a number).
          array_push($modsStrs, " "); # Append mod spaces so that each nucleosomes has "mods" so that it can be inserted into the database.
        }
      }
      else if(count($dnaStrs) < count($modsStrs)){ # If we have more histone chunks than DNA chunks, add a new DNA chunk of unknown bases.
        for($i=0;$i<abs(count($dnaStrs) - count($modsStrs));$i++){ # Difference between the two values (abs() returns the magnitude of a number).
          array_push($dnaStrs, "NNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN"); # Append unknown DNA sequence N signifies unknown, 127 Ns in each append.
        }
      }
      $queries = []; # Array that holds all of our nucleosome queries ONLY.
      $r = mysqli_query($db, "INSERT INTO nucelosomesequence VALUES(NULL, $uid, $did, '".$name."', $notes)"); # Inserts the nucleosome sequence into its table.
      $nsid = mysqli_fetch_array(mysqli_query($db, "SELECT nsid FROM nucelosomesequence WHERE uid=$uid AND name='".$name."'"))[0]; # Fetches the ID of this new record.
      for($i=0;$i<count($dnaStrs);$i++){ # For each nucleosome (defined by number of nucleosome DNA chunks).
        $dna = $dnaStrs[$i]; # Current DNA.
        $mods = $modsStrs[$i]; # Current histone mods.
        $ndsid = -1; # Initialise the ID of the nucleosome DNA sequence.
        $dnaFound = checkDNA($dna); # Check to see if DNA is already in the database.
        if($dnaFound == TRUE){
          $ndsid = mysqli_fetch_array(mysqli_query($db, "SELECT ndsid FROM nucleosomednasequence WHERE DNASequence=$dna"))[0]; # Fetch the ndsid of the mathcing DNA sequence.
        }
        else{ # If no DNA match is found
          $r = mysqli_query($db, "INSERT INTO nucleosomednasequence VALUES(NULL, '".$dna."')"); # Insert a new DNA sequecne into the databse.
          $ndsid = mysqli_fetch_array(mysqli_query($db, "SELECT ndsid FROM nucleosomednasequence WHERE DNASequence='".$dna."'"))[0]; # Fetches the id of the dna sequence we just inserted.
        }
        array_push($queries, "INSERT INTO nucleosome VALUES(NULL, $ndsid, '".$mods."', $nsid)"); # Adds a query to the queries array that inserts a new record to the nucelosome.
      }
      foreach($queries as $query){ # Execute all nucleosome insertion queries.
        $r = mysqli_query($db, $query);
      }
      echo('<script>window.location.href="index.php?page=search&sequenceSubmitted=TRUE";</script>'); # Redirect so that the user does not resubmit the data.
    }
    else{
      echo($popupTop);
      foreach($errors as $error){
        echo('<p>'.$error.'</p>');
      }
      echo($popupBottom);
    }
  }
?>
