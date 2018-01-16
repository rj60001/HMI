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
  $name = strip_tags($trim["sequenceNameT"]);
  $diseaseAssoc = $trim["diseaseAssociationT"];
  $errors = [];
  if($modsStr == "" || $dnaStr == "ATCG" || $name == "Name"){
    $errors = ["Cannot use default values."];
  }
  $result = interpretHistoneModSequence($modsStr, $db);
  # Database storage
  $dnaStrs = str_split($dnaStr, 127);
  $modsStrs = explode("|", $modsStr);
  foreach($modsStrs as $modsString){
    str_replace("|", "", $modsString); # Remove the symbols used to split the modsString.
  }
  $queries = [];
  array_push($queries, "INSERT INTO nucelosomesequence VALUES(0, $uid, $diseaseAssoc, '".$name."')");
  for($i=0;$i<count($dnaStrs);$i++){ # This builds up the nucleosomes from the data we have been given.
    $dnaFound = False;
    $ndsid = -1;
    $r = mysqli_query($db, "SELECT * FROM nucleosomednasequence");
    while($row = mysqli_fetch_array($r)){ #If we find DNA submitted that is already in our database we dont have to enter it into the database.
      if($dnaStrs[$i] == $row[1]){
        $dnaFound = True;
        $ndsid = $row[0]; # Fetch the ndsid if we get a match.
      }
    }
    if($dnaFound == False) { # Create a new DNA sequence for each nucleosome unless that DNA sequence is already in the database.
      array_push($queries, "INSERT INTO nucleosomednasequence VALUES(0, '".$dnaStrs[$i]."')");
      $ndsid = mysqli_fetch_array(mysqli_query($db, "SELECT ndsid FROM nucleosomednasequence ORDER BY ndsid DESC LIMIT 1"))[0]; # Fetch the latest ndsid (aka the one we just submitted).
    }

    $nsid = mysqli_fetch_array(mysqli_query($db, "SELECT nsid FROM nucelosomesequence ORDER BY nsid DESC LIMIT 1"))[0]; # Fecth the nsid from the nucleosomneSequence record we just created.
    array_push($queries, "INSERT INTO nucleosome VALUES(0, $ndsid, '".$modsStrs[$i]."', $nsid)");
  }
  foreach($queries as $query){
    $r = mysqli_query($db, $query);
  }
  displayResults($result, $nsid);
}
?>
