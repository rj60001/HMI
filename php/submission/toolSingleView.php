<?php
  if(isset($trim["submittedTE"]) && isset($_GET["sequence"])){
    $nucleosome = $trim["nucleosomeTE"];
    $mods = $trim["histoneModsTE"];
    $dna = strtoupper($trim["dnaSequenceTE"]);
    $q = "";
    if($nucleosome == "NULL"){ # This means that we need to create a new record.
      $matchResult = checkDNA($dna);
      $ndsid = -1; # Not yet assigned with an actual ID value, but needs to be decared so that it has the correct variable scope.
      if($matchResult == FALSE) {
        $r = mysqli_query($db, "INSERT INTO nucleosomednasequence VALUES(NULL, '$dna')");
      }
      $ndsid = mysqli_fetch_array(mysqli_query($db, "SELECT ndsid FROM nucleosomednasequence WHERE DNASequence='".$dna."'"))[0];
      $q = "INSERT INTO nucleosome VALUES(NULL, $ndsid, '$mods', ".$_GET["sequence"].")";
    }
    else { # This means we need to update a record.
      $matchResult = checkDNA($dna);
      $ndsid = -1; # Not yet assigned with an actual ID value, but needs to be decared so that it has the correct variable scope.
      if($matchResult == FALSE) {
        $r = mysqli_query($db, "INSERT INTO nucleosomednasequence VALUES(NULL, '$dna')"); # Insert a new DNA sequence record as DNA has not been found already in the table.
      }
      $ndsid = mysqli_fetch_array(mysqli_query($db, "SELECT ndsid FROM nucleosomednasequence WHERE DNASequence='".$dna."'"))[0];
      $q = "UPDATE nucleosome SET ndsid='$ndsid', histoneMods='$mods' WHERE nid=$nucleosome";
    }
    $r = mysqli_query($db, $q);
    echo('<script>window.location.href="index.php?page=tool&sequence='.$nsid.'";</script>');
  }
?>
