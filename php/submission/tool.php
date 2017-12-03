<?php
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

function displayResults($result){

}

if(isset($trim["submittedT"])){
  //Interpretation
  $dnaStr = $trim["dnaSequenceT"];
  $modsStr = $trim["histoneModsT"];
  $errors = [];
  if($modsStr == "" || $dnaStr == "ATCG"){
    $errors = ["Cannot use default values."];
  }
  $result = interpretHistoneModSequence($modsStr, $db);
  displayResults($result);
  //Database storage
  $dnaStrs = str_split($dnaStr, 127);
  $queries = ["INSERT INTO nucelosomesequence VALUES(0, NULL, 'poo')"];
  foreach($dnaStrs as $dna){
    $queries = ["INSERT INTO nucleosomednasequence VALUES(0, '".$dna."')"];
    $ndsid = mysqli_fetch_array(mysqli_query($db, "SELECT ndsid FROM nucleosomednasequence ORDER BY ndsid DESC LIMIT 1"))[0];
    $nsid = mysqli_fetch_array(mysqli_query($db, "SELECT nsid FROM nucelosomesequence ORDER BY nsid DESC LIMIT 1"))[0];
    $queries = ["INSERT INTO nucleosome VALUES(0, $ndsid, '$modsStr', $nsid)"];
  }
  foreach($queries as $query){
    $r = mysqli_query($db, $query);
  }
}
?>
