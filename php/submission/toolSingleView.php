<?php
  if(isset($trim["submittedTE"]) && isset($_GET["sequence"])){ # Editing a sequence.
    $nucleosome = $trim["nucleosomeTE"];
    $mods = $trim["histoneModsTE"];
    $dna = strtoupper($trim["dnaSequenceTE"]);
    $q = "";
    $matchResult = checkDNA($dna); # Check to see if DNA is already in the database.
    $ndsid = -1; # Not yet assigned with an actual ID value, but needs to be decared so that it has the correct variable scope.
    if($matchResult == FALSE) {
      $r = mysqli_query($db, "INSERT INTO nucleosomednasequence VALUES(NULL, '$dna')"); # Insert a new record into the nucleosomednasequence table.
      $ndsid = mysqli_fetch_array(mysqli_query($db, "SELECT ndsid FROM nucleosomednasequence ORDER BY ndsid DESC LIMIT 1"))[0]; # Fetch the ID from the latest record (the one we just submitted).
    }
    else {
      $ndsid = mysqli_fetch_array(mysqli_query($db, "SELECT ndsid FROM nucleosomednasequence WHERE DNASequence='".$dna."'"))[0]; # Fetch the nucelsome DNA sequence ID
    }
    if($nucleosome == "NULL"){ # This means that we need to create a new record.
      $q = "INSERT INTO nucleosome VALUES(NULL, $ndsid, '$mods', ".$_GET["sequence"].")"; # Query for creating a new nucleosome record.
    }
    else { # This means we need to update a record.
      $q = "UPDATE nucleosome SET ndsid=$ndsid, histoneMods='$mods' WHERE nid=$nucleosome"; # Update the values of an already existing nucleosome.
    }
    $r = mysqli_query($db, $q);
    echo('<script>window.location.href="index.php?page=tool&sequence='.$nsid.'";</script>'); # Reload the page to see the differences.
  }
  else if(isset($trim["submittedTEO"]) && isset($_GET["sequence"])){ # If the overview details of a sequence is being edited.
    $nsid = $_GET["sequence"];
    $notes = checkNotes(strip_tags($trim["notesTEO"]));
    $name = strip_tags($trim["nameTEO"]);
    $did = $trim["diseaseAssociationTEO"];
    $errors = [];

    if($name == "Name"){
      $errors = ["Cannot use default values."];
    }

    if(empty($errors)){
      $r = mysqli_query($db, "UPDATE nucelosomesequence SET notes=$notes, name='$name', did=$did WHERE nsid=$nsid"); # Update the nucleosome sequence record with the new overview data.
      echo('<script>window.location.href="index.php?page=tool&sequence='.$nsid.'";</script>'); # Reload the page to see the differences.
    }
    else {
      echo($popupTop);
      foreach($errors as $error){
        echo('<p>'.$error.'</p>');
      }
      echo($popupBottom);
    }
  }
  else if(isset($trim["submittedTEO"]) && isset($_GET["disease"])){ # If the user is editing the disease overview.
    $did = $_GET["disease"];
    $notes = strip_tags($trim["notesTEO"]);
    $name = strip_tags($trim["nameTEO"]);
    $errors = [];

    if($name == "Name"){
      $errors = ["Cannot use default values."];
    }

    if(empty($errors)){
      $r = mysqli_query($db, "UPDATE disease SET notes=$notes, name='$name' WHERE did=$did"); # Update the overview values of the disease.
      echo('<script>window.location.href="index.php?page=tool&disease='.$did.'";</script>'); # Reload the page so that we can see the differences.
    }
    else {
      echo($popupTop);
      foreach($errors as $error){
        echo('<p>'.$error.'</p>');
      }
      echo($popupBottom);
    }
  }
  else if(isset($trim["nsidTD"]) && isset($_GET["disease"])){ # If the user is removing a sequence-disease association.
    $nsid = $trim["nsidTD"]; # Fetch the ID of the sequence.
    $r = mysqli_query($db, "UPDATE nucelosomesequence SET did IS NULL WHERE nsid=$nsid"); # Stop it from being related to disease record.
    echo('<script>window.location.href="index.php?page=tool&disease='.$did.'";</script>'); # Reload the disease page to see the differences.
  }
?>
