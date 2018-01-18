<?php
  if(isset($trim["submittedD"])){
    $name = strip_tags($trim["diseaseNameD"]);
    $errors = [];
    if($name == "Disease name"){
      $errors = ["Name cannot be default value"];
    }
    else { # This checks to see if the disease is already in the database. One or the other as 'Disease Name' cannot be submitted as a value so it wont be in the database.
      $r = mysqli_query($db, "SELECT name FROM disease"); # Selects all of the name in the disease table.
      while($row = mysqli_fetch_array($r)){ # For each row in the table.
        if($row[0] == $name){ # Checks if the user-inputted name is the same as the current row.
          $errors = ["Disease already in the database"];
        }
      }
    }

    if(empty($errors)){
      $q = "INSERT INTO disease VALUES(NULL, '".$name."')";
      $r = mysqli_query($db, $q);
      echo("<script>window.location.href = 'index.php?page=tool&diseaseSubmitted=TRUE';</script>");
    }
    else {
      echo($popupTop);
      foreach($errors as $error){
        echo('<p>'.$error.'</p>');
      }
      echo($popupBottom);
    }
  }
  if(isset($trim["submittedT"])){ # This is for submitting a new sequence.
    $dnaStr = $trim["dnaSequenceT"];
    $modsStr = $trim["histoneModsT"]."|"; # Allows us to extract the last histone in the list.
    $name = strip_tags($trim["sequenceNameT"]);
    $diseaseAssoc = $trim["diseaseAssociationT"];
    $errors = [];
    if($modsStr == "" || $dnaStr == "ATCG" || $name == "Name"){
      $errors = ["Cannot use default values."];
    }
    if(empty($errors)){
      $result = interpretHistoneModSequence($modsStr, $db);
      $dnaStrs = str_split($dnaStr, 127);
      $modsStrs = explode("|", $modsStr);
      foreach($modsStrs as $modsString){
        str_replace("|", "", $modsString); # Remove the symbols used to split the modsString.
      }
      $queries = [];
      array_push($queries, "INSERT INTO nucelosomesequence VALUES(0, $uid, $diseaseAssoc, '".$name."')");
      for($i=0;$i<count($dnaStrs);$i++){ # This builds up the nucleosomes from the data we have been given.
        $dnaFound = 0;
        $ndsid = -1;
        $r = mysqli_query($db, "SELECT * FROM nucleosomednasequence");
        while($row = mysqli_fetch_array($r)){ #If we find DNA submitted that is already in our database we dont have to enter it into the database.
          if($dnaStrs[$i] == $row[1]){
            $dnaFound = 1;
            $ndsid = $row[0]; # Fetch the ndsid if we get a match.
          }
        }
        if($dnaFound != 1) { # Create a new DNA sequence for each nucleosome unless that DNA sequence is already in the database.
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
    else {
      echo($popupTop);
      foreach($errors as $error){
        echo('<p>'.$error.'</p>');
      }
      echo($popupBottom);
    }
  }
?>
