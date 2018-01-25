<?php
  if(isset($trim["submittedTE"]) && isset($_GET["sequence"])){ # Editing a sequence.
    $nucleosome = $trim["nucleosomeTE"];
    $mods = $trim["histoneModsTE"];
    $dna = strtoupper($trim["dnaSequenceTE"]);

    $q = "";
    $matchResult = checkDNA($dna);
    $ndsid = -1; # Not yet assigned with an actual ID value, but needs to be decared so that it has the correct variable scope.
    if($matchResult == FALSE) {
      $r = mysqli_query($db, "INSERT INTO nucleosomednasequence VALUES(NULL, '$dna')");
    }
    $ndsid = mysqli_fetch_array(mysqli_query($db, "SELECT ndsid FROM nucleosomednasequence WHERE DNASequence='".$dna."'"))[0];
    if($nucleosome == "NULL"){ # This means that we need to create a new record.
      $q = "INSERT INTO nucleosome VALUES(NULL, $ndsid, '$mods', ".$_GET["sequence"].")";
    }
    else { # This means we need to update a record.
      $q = "UPDATE nucleosome SET ndsid=$ndsid, histoneMods='$mods' WHERE nid=$nucleosome";
    }
    $r = mysqli_query($db, $q);
    echo('<script>window.location.href="index.php?page=tool&sequence='.$nsid.'";</script>');
  }
  else if(isset($trim["nsidTD"]) && isset($_GET["disease"])){ # Editing a disease.
    $nsid = $trim["nsidTD"];
    $r = mysqli_query($db, "UPDATE nucelosomesequence SET did=NULL WHERE nsid=$nsid");
    echo('<script>window.location.href="index.php?page=tool&disease='.$did.'";</script>');
  }
  else if(isset($trim["nidTD"]) && isset($_GET["sequence"])){
    $nid = $trim["nidTD"];
    $r = mysqli_query($db, "DELETE FROM nucleosome WHERE nid=$nid");
    echo('<script>window.location.href="index.php?page=tool&sequence='.$nsid.'";</script>');
  }
  else if(isset($trim["didTD"]) && isset($_GET["disease"])){
    $nsid = $trim["nsidTD"]; # Fecth the id of the sequence.
    $r = mysqli_query($db, "UPDATE nucelosomesequence SET did IS NULL WHERE nsid=$nsid"); # Stop it from being related to disease record.
    echo('<script>window.location.href="index.php?page=tool&disease='.$did.'";</script>');
  }
  else if(isset($trim["submittedTEO"]) && isset($_GET["sequence"])){
    $nsid = $_GET["sequence"];
    $notes = strip_tags($trim["notesTEO"]);
    $name = strip_tags($trim["nameTEO"]);
    $did = $trim["diseaseAssociationTEO"];
    $errors = [];

    if($name == "Name"){
      $errors = ["Cannot use default values."];
    }

    if(empty($errors)){
      $r = mysqli_query($db, "UPDATE nucelosomesequence SET (notes='$notes', name='$name', did=$did) WHERE nsid=$nsid");
      echo('<script>window.location.href="index.php?page=tool&sequence='.$nsid.'";</script>');
    }
    else {
      echo($popupTop);
      foreach($errors as $error){
        echo('<p>'.$error.'</p>');
      }
      echo($popupBottom);
    }
  }
  else if(isset($trim["submittedTEO"]) && isset($_GET["disease"])){
    $did = $_GET["disease"];
    $notes = strip_tags($trim["notesTEO"]);
    $name = strip_tags($trim["nameTEO"]);
    $errors = [];

    if($name == "Name"){
      $errors = ["Cannot use default values."];
    }

    if($notes == "Notes"){
      $notes = "NULL";
    }
    else {
      $notes = "'".$notes."'";
    }

    if(empty($errors)){
      $r = mysqli_query($db, "UPDATE disease SET (notes='$notes', name='$name') WHERE did=$did");
      echo('<script>window.location.href="index.php?page=tool&disease='.$did.'";</script>');
    }
    else {
      echo($popupTop);
      foreach($errors as $error){
        echo('<p>'.$error.'</p>');
      }
      echo($popupBottom);
    }
  }
?>
