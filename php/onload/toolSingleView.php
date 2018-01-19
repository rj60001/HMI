<?php
  if(isset($_GET["sequence"])){ # If we are retriving a specific sequence.
    echo("<script>document.getElementById('toolSingleViewPageContent').innerHTML='");
    $nsid = $_GET["sequence"];
    $name = mysqli_fetch_array(mysqli_query($db, "SELECT name FROM nucelosomesequence WHERE nsid=$nsid"))[0]; # Fetch the sequence name.
    echo("<p>$name</p><hr>"); # And display it.
    $r = mysqli_query($db, "SELECT histoneMods, ndsid FROM nucleosome WHERE nsid=$nsid ORDER BY nsid"); # Fetch data on all nucleosome related to this sequence.
    $counter = 0;                                                                                       # Orders from first to last (ascending by default).
    while($row = mysqli_fetch_array($r)){
      $counter++;
      echo('<p class="text">Nucleosome '.$counter.'<p>'); # Print the next nucleosome number in the sequence.
      $dnaSequence = mysqli_fetch_array(mysqli_query($db, "SELECT DNASequence FROM nucleosomednasequence WHERE ndsid=".$row[1]))[0];
      echo('<p class="text"><em>DNA Sequence:</em><br>'.$dnaSequence.'</p><p class="text"><em>Histone Mods:</em><br>');
      $mods = explode(",", $row[0]);
      for($i=0;$i<count($mods);$i++){
        $mod = (int)$mods[$i]; # Select the current histone modification ID (hmid).
        $modName = mysqli_fetch_array(mysqli_query($db, "SELECT name FROM histonemods WHERE hmid=".$mod))[0]; # Select the histone modification name.
        $final = $modName." , ";
        if($i != count($mods)-1){
          $final = $modName;
        }
        echo($final);
      }
    }
    echo("';</script>");
  }
  else if(isset($_GET["disease"])){ # If we are retriving the data on a specific disease.
    echo("<script>document.getElementById('toolSingleViewPageContent').innerHTML='");
    $did = $_GET["sequence"];
    echo("';</script>");
  }
?>
