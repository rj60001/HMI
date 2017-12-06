<?php
  if(isset($_GET["searchType"])){
    $type = $_GET["searchType"];
    if($type == "tool" && isset($_GET["disease"]) && isset($_GET["sequence"])){
      echo('<script>menuBtnClick("searchView"); document.getElementById("searchViewPageContent").innerHTML = \'');
      $id = $_GET["sequence"];
      $queries = [];
      if($_GET["disease"] == "1"){
        array_push($queries, "SELECT name FROM disease WHERE did=".$id);
        $r = mysqli_query($db, "SELECT nsid, name FROM nucelosomesequence WHERE did=".$id);
        while($row = mysqli_fetch_array($r)){
          array_push($queries, "SELECT DNASequence, histoneMods FROM nucleosome WHERE nsid=".$row[0]);
        }
      }
      else {
        array_push($queries, "SELECT name FROM nucelosomesequence WHERE nsid=".$id);
        array_push($queries, "SELECT DNASequence, histoneMods FROM nucleosome INNER JOIN nucleosomednasequence ON nucleosome.ndsid = nucleosomednasequence.ndsid WHERE nsid=".$id);
      }

      foreach($queries as $q){
        $row = mysqli_fetch_array(mysqli_query($db, $q));
        if(!isset($row[1])){
          echo('<p class="subtitle">'.$row[0].'</p><br><br><hr>');
        }
        else{ //If two elements are in the array we must be looking at single nucleosome data.
          $mods = explode(',', $row[1]);
          $modsStr = "";
          foreach($mods as $mod){
            $modsStr .= mysqli_fetch_array(mysqli_query($db, "SELECT name FROM histonemods WHERE hmid=".intval($mod)))[0]." ";
          }
          echo('<p class="text"><em>Nucleosome</em></p><p class="text"><b>DNA Sequence: </b>'.$row[0].'<br><b>Histone Modification Sequence: </b>'.$modsStr.'</p>');
        }
      }
      echo('\';</script>');
    }
  }
?>
