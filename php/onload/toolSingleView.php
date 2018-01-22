<?php
  if(isset($_GET["sequence"])){ # If we are retriving a specific sequence.
    echo("<script>document.getElementById('toolSingleViewPageContent').innerHTML='");
    $nsid = $_GET["sequence"];
    $row = mysqli_fetch_array(mysqli_query($db, "SELECT name, notes FROM nucelosomesequence WHERE nsid=$nsid"));
    $name = $row[0]; # Fetch the sequence name.
    $notes = $row[1];
    echo('<p class="text"><b>'.$name.'</b></p><br><hr>'); # And display it.
    $r = mysqli_query($db, "SELECT histoneMods, ndsid, nid FROM nucleosome WHERE nsid=$nsid ORDER BY nsid"); # Fetch data on all nucleosome related to this sequence.
    $counter = 0; # Defines the nucleosome number (to give it an arbitary name).                           Orders from first to last (ascending by default).
    $html= '';
    $allMods = []; # Collects all mods.
    $allDNA = '';
    $nucleosomes = []; # Two dimensional array that will contain the number and the nucelosome id for each nucleosome. Name Number (counter) : nucleosome id.
    while($row = mysqli_fetch_array($r)){
      $html .= '<div class="strip redPurple floatAesthetic">';
      $counter++;
      $html .= '<p class="text"><b>Nucleosome '.$counter.'</b><p><br><hr>'; # Print the next nucleosome number in the sequence.
      $dnaSequence = mysqli_fetch_array(mysqli_query($db, "SELECT DNASequence FROM nucleosomednasequence WHERE ndsid=".$row[1]))[0];
      $allDNA .= $dnaSequence;
      $html .= '<p class="text"><em>DNA Sequence:</em><br>'.$dnaSequence.'</p><p class="text"><em>Histone Mods:</em><br>';
      $mods = explode(",", $row[0]);
      for($i=0;$i<count($mods);$i++){
        $mod = (int)$mods[$i]; # Select the current histone modification ID (hmid).
        $modName = mysqli_fetch_array(mysqli_query($db, "SELECT name FROM histonemods WHERE hmid=".$mod))[0]; # Select the histone modification name
        $final = $modName;
        $value = $i <=> (count($mods)-2); # Returns -1 if $i is less than count($mods)-1, 0 if equal two or 1 if greater than. This si called the spaceship operator.
        if($value == -1){
          $final .= " , ";
        }
        $html .= $final;
        array_push($allMods, $mod); # Push each mod into the array of all mods. we must do it here instead of just adding the $mods array so that we don't get a two dimensional array.
      }
      $html .= '</div><br><br>';
      array_push($nucleosomes, [$counter, $row[2]]); # Append the array. $row[2] holds the nucleosome id.
    }
    $row = mysqli_fetch_array(mysqli_query($db, "SELECT disease.did, disease.name FROM disease INNER JOIN nucelosomesequence ON disease.did=nucelosomesequence.did WHERE nsid=$nsid"));
    echo('<div class="strip greenYellow floatAesthetic" onclick="window.location.href=`index.php?page=tool&disease='.$row[0].'`"><p class="text">This sequence is derived from: <b>'.$row[1].'</b></p></div><br><br>');
    echo('<div class="strip greenYellow floatAesthetic"><p class="text"><b>Overall</b></p><p class="text"><em>Full DNA Sequence: <br></em>'.$allDNA.'</p><p class="text"><em>Result: <br></em>'.interpretHistoneModSequence($allMods, $db, 'a').'</p><br><p class="text"><em>Notes: </em><br>'.$notes.'</p></div><br><br>'); # This must be pritned first before everthing else so that it stays at the top of the page.
    echo($html);
    echo('<form id="toolForm" class="orangeBlue floatingAesthetic" action="index.php?page=tool&sequence='.$nsid.'" method="post"><p class="text">Edit</p><br><br><select name="nucleosomeTE" onfocus="selected(this);" onblur="deselected(this);"><option value="NULL">New nucleosome</option>');
    foreach($nucleosomes as $n){
      echo('<option value="'.$n[1].'"> Nucleosome '.$n[0].'</option>');
    }
    echo('</select><textarea id="dnaSequenceTE" name="dnaSequenceTE" maxlength="127" info="ATCG" onkeydown="dnaInputCheck(this);" onfocus="clearValue(this); selected(this);" onblur="restoreValue(this); deselected(this);">ATCG</textarea><br><br><div id="hmodBg"><div id="hmodSequenceTE" class="toolCon"></div></div><br><br>');
    echo('<div id="histoneModDiv"><div class="toolCon"><div id="removeHistoneBtn" class="button histoneMod" onclick="removeLastHmod(`hmodSequenceTE`, `histoneModsTE`);">Remove</div>');
            $q = "SELECT hmid, name FROM histonemods";
            $r = mysqli_query($db, $q);
            while($row = mysqli_fetch_array($r)){
              echo('<div class="button histoneMod" onclick="addHmod(`'.$row[1].'`, `'.$row[0].'`, `hmodSequenceTE`, `histoneModsTE`);">'.$row[1].'</div>');
            }
    echo('</div></div><input id="histoneModsTE" name="histoneModsTE" type="hidden"/>');
    echo('<input type="submit" name="submitTE" value="Edit"/><input type="hidden" name="submittedTE" value="TRUE"/>');
    echo("';</script>");
  }
  else if(isset($_GET["disease"])){ # If we are retriving the data on a specific disease.
    echo("<script>document.getElementById('toolSingleViewPageContent').innerHTML='");
    $did = $_GET["disease"];
    $row = mysqli_fetch_array(mysqli_query($db, "SELECT name, notes FROM disease WHERE did=$did"));
    echo('<br><div class="strip greenYellow floatAesthetic"><p class="text"><b>'.$row[0].'</b></p><br><p>'.$row[1].'</p></div><br><br>');
    $r = mysqli_query($db, "SELECT nsid, name, notes FROM nucelosomesequence WHERE did=$did");
    while($row = mysqli_fetch_array($r)){
      echo('<div class="strip redPurple floatAesthetic" onclick="window.location.href=`index.php?page=tool&sequence='.$row[0].'`;"><p class="text">'.$row[1].'</p><br><p class="text">'.$row[2].'</p></div><br><br>');
    }

    echo("';</script>");
  }
?>
