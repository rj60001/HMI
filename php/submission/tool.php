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

function displayResults($result, $nsid){
  echo($popupTop."<p>This is your result: <br>".$result."</p>".$popupBottom);
}

if(isset($trim["submittedT"])){
  //Interpretation
  $dnaStr = $trim["dnaSequenceT"];
  $modsStr = $trim["histoneModsT"];
  $name = $trim["sequenceName"];
  $errors = [];
  if($modsStr == "" || $dnaStr == "ATCG"){
    $errors = ["Cannot use default values."];
  }
  $result = interpretHistoneModSequence($modsStr, $db);
  //Database storage
  $dnaStrs = str_split($dnaStr, 127);
  $queries = [];
  array_push($queries, "INSERT INTO nucelosomesequence VALUES(0, NULL, 'poo')");
  foreach($dnaStrs as $dna){
    array_push($queries, "INSERT INTO nucleosomednasequence VALUES(0, '".$dna."')");
    $ndsid = mysqli_fetch_array(mysqli_query($db, "SELECT ndsid FROM nucleosomednasequence ORDER BY ndsid DESC LIMIT 1"))[0];
    $nsid = mysqli_fetch_array(mysqli_query($db, "SELECT nsid FROM nucelosomesequence ORDER BY nsid DESC LIMIT 1"))[0];
    array_push($queries, "INSERT INTO nucleosome VALUES(0, $ndsid, '$modsStr', $nsid)");
  }
  foreach($queries as $query){
    $r = mysqli_query($db, $query);
  }
  displayResults($result, $nsid);
}
else if(isset($_GET["searchText"])){
  $searchStr = $_GET["searchText"];
  $q = "SELECT nsid, name FROM nucelosomesequence WHERE name LIKE '%".$searchStr."%'";
  $r = mysqli_query($db, $q);
  $row = mysqli_fetch_array($r);
  $nucleosomes = mysqli_query($db, "SELECT * FROM nucleosome WHERE nsid=".$row[0]);
  echo('<script>document.getElementById("toolSingleView").innerHTML="<p class=\'text\'><b>Nucleosome Sequence Name: </b>'.$row[1].'</p>');
  while($row = mysqli_fetch_array($nucleosomes)){
    #Code
  }
  echo('";</script>');
}
?>
