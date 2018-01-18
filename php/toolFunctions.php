<?php
  # Functions for both forms of submission
  function interpretHistoneModSequence($modsStr, $db){
    $mods = explode(",", $modsStr);
    $result = 0;
    foreach($mods as $mod){
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
  # ===
?>
