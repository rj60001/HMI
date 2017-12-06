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
  $name = strip_tags($trim["sequenceName"]);
  $errors = [];
  if($modsStr == "" || $dnaStr == "ATCG" || $name == "Name"){
    $errors = ["Cannot use default values."];
  }
  $result = interpretHistoneModSequence($modsStr, $db);
  //Database storage
  $dnaStrs = str_split($dnaStr, 127);
  $queries = [];
  array_push($queries, "INSERT INTO nucelosomesequence VALUES(0, NULL, '".$name."')");
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
else if(isset($_GET["searchText"]) && isset($_GET["page"])){
  echo('<script>menuBtnClick("searchView"); document.getElementById("searchViewPageContent").innerHTML = \'<hr><br><br>');
  if($_GET["page"] == "tool"){
    $r = mysqli_query($db, "SELECT name, nsid FROM nucelosomesequence WHERE name LIKE '%".$_GET['searchText']."%'");
    while($row = mysqli_fetch_array($r)){
      echo('<div class="strip" onclick="searchRedirect('.$row[1].', false, true);">'.$row[0].'</div><br><br>');
    }
    echo('\';</script>');
  }
  else if($_GET["page"] == "forum") {
    #For searching the forum.
  }
}
?>
