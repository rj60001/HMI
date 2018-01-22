<?php
  # Functions for both forms of submission
  function interpretHistoneModSequence($mods, $db, $type = 's'){
    $modsArray = [];
    if($type == 's'){
      $modsArray = explode(",", $mods);
    }
    else {
      $modsArray = $mods;
    }
    $result = 0;
    foreach($modsArray as $mod){
      $q = "SELECT effectType, magnitude FROM histonemods WHERE hmid=".intval($mod);
      $r = mysqli_query($db, $q);
      $row = mysqli_fetch_array($r);
      if($row[0] == "1"){
        $result -= $row[1];
      }
      else {
        $result += $row[1];
      }
    }
    return $result;
  }

  function displayResults($result, $nsid){
    global $popupTop, $popupBottom; # This lets us use the specified global varibables.
    echo($popupTop."<p>This is your result: <br>".$result."</p>".$popupBottom);
  }

  function checkDNA($dna){ # THis checks to see if a DNA sequence has already been added to the database.
    global $db;
    $r = mysqli_query($db, "SELECT DNASequence FROM nucleosomednasequence"); # Fetches all current DNA sequences form the database.
    while($row = mysqli_fetch_array($r)){ # Checks each row to see if it has a dna sequence that matches our one ($dna).
      if($dna == $row[0]){
        return TRUE; # Return the boolean true if so.
      }
    }
    return FALSE; # If no match is found return false.
  }
  # ===
?>
