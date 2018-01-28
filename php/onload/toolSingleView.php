<?php
  if(isset($_GET["sequence"])){ # If we are retriving a specific sequence.
    echo("<script>document.getElementById('toolSingleViewPageContent').innerHTML='");
    $nsid = $_GET["sequence"];
    $row = mysqli_fetch_array(mysqli_query($db, "SELECT name, notes, uid FROM nucelosomesequence WHERE nsid=$nsid"));
    $name = $row[0]; # Fetch the sequence name.
    $notes = $row[1];
    $ownerid = $row[2];
    echo('<p class="sequenceDiseaseTitle">'.$name.'</p><br><hr>'); # And display it.
    $r = mysqli_query($db, "SELECT histoneMods, ndsid, nid FROM nucleosome WHERE nsid=$nsid ORDER BY nsid"); # Fetch data on all nucleosome related to this sequence.
    $counter = 0; # Defines the nucleosome number (to give it an arbitary name).                           Orders from first to last (ascending by default).
    $html= '';
    $allMods = []; # Collects all mods.
    $allDNA = '';
    $nucleosomes = []; # Two dimensional array that will contain the number and the nucelosome id for each nucleosome. Name Number (counter) : nucleosome id.
    while($row = mysqli_fetch_array($r)){
      $nid = $row[2];
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
      if($uid == $ownerid){ # Checks to see if the user owns this sequence.
        $html .= '<form action="index.php?page=tool&sequence='.$nsid.'" method="post"><input name="nidTD" type="hidden" value="'.$nid.'"/><input name="submitTD" class="removeDeleteButton" type="submit" value="Delete" onfocus="selected(this);" onblur="deselected(this);"/></form>';
      }
      $html .= '</div><br><br>';
      array_push($nucleosomes, [$counter, $nid]); # Append the array. $row[2] holds the nucleosome id.
    }
    $r = mysqli_query($db, "SELECT disease.did, disease.name FROM disease INNER JOIN nucelosomesequence ON disease.did=nucelosomesequence.did WHERE nsid=$nsid");
    $row = mysqli_fetch_array($r);
    $did = $row[0];
    $diseaseName = $row[1];
    $result = interpretHistoneModSequence($allMods, $db, 'a');
    if($result > 0){
      $result = "+".$result;
    }
    echo('<div class="strip greenYellow floatAesthetic" onclick="window.location.href=`index.php?page=tool&disease='.$did.'`"><p class="text">This sequence is derived from: <b>'.$diseaseName.'</b></p></div><br><br>');
    echo('<div class="strip greenYellow floatAesthetic"><p class="text"><b>Overall</b></p><p class="text"><em>Full DNA Sequence: <br></em>'.$allDNA.'</p><p class="text"><em>Expression Change Result: <br></em>'.$result.'</p><br><p class="text"><em>Notes: </em><br>'.$notes.'</p></div><br><br>'); # This must be pritned first before everthing else so that it stays at the top of the page.
    echo($html);
    if($uid == mysqli_fetch_array(mysqli_query($db, "SELECT uid FROM nucelosomesequence WHERE nsid=$nsid"))[0] || $admin == TRUE){ # Editing for owner and admin only.
      if($notes == ""){
        $notes = isset($trim["notesTEO"]) ? $trim["notesTEO"] : "Notes";
      }
      echo ('<form id="toolForm" class="orangeBlue floatingAesthetic" action="index.php?page=tool&sequence='.$nsid.'" method="post"><p class="text">Edit Overall Details</p><br><br><select name="diseaseAssociationTEO">');
      if($did){
        echo('<option selected="selected" value="'.$did.'">'.$diseaseName.'</option>');
        $q = "SELECT did, name FROM disease WHERE did!=$did";
      }
      else {
        $q = "SELECT did, name FROM disease";
      }
      global $q;
      echo('<option value="NULL">No association</option>');
      $r = mysqli_query($db, $q); # Fetched all rows except the row that we have already retrived and displayed first in the drop box input
      while($row = mysqli_fetch_array($r)){
        echo('<option value="'.$row[0].'">'.$row[1].'</option>');
      }
      echo('</select><textarea name="notesTEO" info="Notes" onfocus="clearValue(this); selected(this);" onblur="restoreValue(this); deselected(this);">'.$notes.'</textarea>');
      echo('<input name="nameTEO" type="text" value="'.$name.'" info="Name" onfocus="clearValue(this); selected(this);" onblur="restoreValue(this); deselected(this);"/>');
      echo('<input type="hidden" name="submittedTEO" value="TRUE"/><input type="submit"" name="submitTEO" value="Edit" onfocus="selected(this);" onblur="deselected(this);"/></form>');
      echo('<form id="toolForm" class="orangeBlue floatingAesthetic" action="index.php?page=tool&sequence='.$nsid.'" method="post"><p class="text">Edit</p><br><br><select name="nucleosomeTE" onfocus="selected(this);" onblur="deselected(this);"><option value="NULL">New nucleosome</option>');
      foreach($nucleosomes as $n){
        echo('<option value="'.$n[1].'"> Nucleosome '.$n[0].'</option>');
      }
      $dnaTE = isset($trim["dnaSequenceTE"]) ? $trim["dnaSequenceTE"] : "ATCG";
      $modsStrTE = isset($trim["histoneModsTE"]) ? $trim["histoneModsTE"] : "";
      $viewingModsTE = "";
      $mods = explode(",", $modsStr);
      foreach($mods as $mod){
        $name = mysqli_fetch_array(mysqli_query($db, "SELECT name FROM histonemods WHERE hmid=".intval($mod)))[0];
        $viewingModsTE .= $name." ";
      }
      echo('</select><textarea id="dnaSequenceTE" name="dnaSequenceTE" maxlength="127" info="ATCG" onkeydown="dnaInputCheck(this);" onfocus="clearValue(this); selected(this);" onblur="restoreValue(this); deselected(this);">'.$dnaTE.'</textarea><br><br><div id="hmodBg"><div id="hmodSequenceTE" class="toolCon">'.$viewingModsTE.'</div></div><br><br>');
      echo('<div id="histoneModDiv"><div class="toolCon"><div id="removeHistoneBtnTE" class="button histoneMod" onclick="removeLastHmod(`hmodSequenceTE`, `histoneModsTE`);">Remove</div>');
              $q = "SELECT hmid, name FROM histonemods";
              $r = mysqli_query($db, $q);
              while($row = mysqli_fetch_array($r)){
                echo('<div class="button histoneMod" onclick="addHmod(`'.$row[1].'`, `'.$row[0].'`, `hmodSequenceTE`, `histoneModsTE`);">'.$row[1].'</div>');
              }
      echo('</div></div><input id="histoneModsTE" name="histoneModsTE" type="hidden" value="'.$modsStrTE.'"/>');
      echo('<input type="submit" name="submitTE" value="Edit"/><input type="hidden" name="submittedTE" value="TRUE"/>');
    }
    echo("';</script>");
  }
  else if(isset($_GET["disease"])){ # If we are retriving the data on a specific disease.
    echo("<script>document.getElementById('toolSingleViewPageContent').innerHTML='");
    $did = $_GET["disease"];
    $row = mysqli_fetch_array(mysqli_query($db, "SELECT name, notes, uid FROM disease WHERE did=$did"));
    $name = $row[0];
    $notes = $row[1];
    if($notes == ""){
      $notes = isset($trim["notesTEO"]) ? $trim["notesTEO"] : "Notes";
    }
    $ownerid = $row[2];
    echo('<br><div class="strip greenYellow floatAesthetic"><p class="text"><b>'.$name.'</b></p><br><p>'.$notes.'</p></div><br><br>');
    $r = mysqli_query($db, "SELECT nsid, name, notes FROM nucelosomesequence WHERE did=$did");
    while($row = mysqli_fetch_array($r)){
      $nsid = $row[0];
      echo('<div class="strip redPurple floatAesthetic" onclick="window.location.href=`index.php?page=tool&sequence='.$nsid.'`;"><p class="text">'.$row[1].'</p><br><p class="text">'.$row[2].'</p>');
      if($uid == $ownerid){ # Checks to see if the user owns this sequence.
        echo('<form action="index.php?page=tool&disease='.$did.'" method="post"><input name="nsidTD" type="hidden" value="'.$nsid.'"/><input name="submitTD" class="removeDeleteButton" type="submit" value="Remove" onfocus="selected(this);" onblur="deselected(this);"/></form>');
      }
      echo('</div><br><br>');
    }

    if($uid == $ownerid || $admin == TRUE){ # Editing for owner and admin only.
      echo ('<form id="toolForm" class="orangeBlue floatingAesthetic" action="index.php?page=tool&disease='.$did.'" method="post"><p class="text">Edit Overall Details</p><br><br>');
      echo('<textarea name="notesTEO" info="Notes" onfocus="clearValue(this); selected(this);" onblur="restoreValue(this); deselected(this);">'.$notes.'</textarea>');
      echo('<input name="nameTEO" type="text" value="'.$name.'" info="Name" onfocus="clearValue(this); selected(this);" onblur="restoreValue(this); deselected(this);"/>');
      echo('<input type="hidden" name="submittedTEO" value="TRUE"/><input type="submit"" name="submitTEO" value="Edit" onfocus="selected(this);" onblur="deselected(this);"/></form>');
    }
    echo("';</script>");
  }
?>
