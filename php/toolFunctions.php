<?php
  # Functions for both the edit tool form and the create tool form, for both submission and on-load pages.
  function interpretHistoneModSequence($mods, $db){
    $modsArray = []; # Initialise the array.
    if($type == 's'){
      $modsArray = explode(",", $mods);
    }
    else {
      $modsArray = $mods;
    }
    $result = 0; # Initilaise the result varibale.
    foreach($modsArray as $mod){ # For each mod in the sequence.
      $q = "SELECT effectType, magnitude FROM histonemods WHERE hmid=".intval($mod);
      $r = mysqli_query($db, $q); # Fetch the magnitude of its effect and whether or not it is repressive.
      $row = mysqli_fetch_array($r); # Fetch the actualy values of these.
      if($row[0] == "1"){ # If a repressive effect, decrease $result.
        $result -= $row[1];
      }
      else { # If an activator effect, increase $result.
        $result += $row[1];
      }
    }
    return $result;
  }

  function checkDNA($dna){ # This checks to see if a DNA sequence has already been added to the database.
    global $db;
    $r = mysqli_query($db, "SELECT DNASequence FROM nucleosomednasequence"); # Fetches all current DNA sequences form the database.
    while($row = mysqli_fetch_array($r)){ # Checks each row to see if it has a dna sequence that matches our one ($dna).
      if($dna == $row[0]){
        return TRUE; # Return the boolean true if so.
      }
    }
    return FALSE; # If no match is found return false.
  }

  function checkNotes($notes){ # Allows for notes to be NULL to save database storage.
    if($notes == "Notes"){
      $notes = "NULL";
    }
    else{
      $notes = "'".$notes."'"; # SQL-friendly string.
    }
    return $notes;
  }
  # ===
?>
