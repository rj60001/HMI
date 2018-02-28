<?php
  if(isset($_GET["sequence"])){ # If we are retriving a specific sequence.
    echo("<script>document.getElementById('toolSingleViewPageContent').innerHTML='");
    $nsid = $_GET["sequence"];
    $queryueryResultow = mysqli_fetch_array(mysqli_query($db, "SELECT name, notes, uid FROM nucelosomesequence WHERE nsid=$nsid"));
    $name = $queryueryResultow[0]; # Fetch the sequence name.
    $notes = $queryueryResultow[1];
    $ownerid = $queryueryResultow[2];
    echo('<p class="sequenceDiseaseTitle">'.$name.'</p><br><hr>'); # And display it.
    $queryueryResult = mysqli_query($db, "SELECT histoneMods, ndsid, nid FROM nucleosome WHERE nsid=$nsid ORDER BY nsid"); # Fetch data on all nucleosome related to this sequence.
    $counter = 0; # Defines the nucleosome number (to give it an arbitary name).                           Orders from first to last (ascending by default).
    $allComponents = new dictionary(["allDNA", "", "allHistoneModifications", ""]); # Stores the DNA and histone modifications contained within the whole sequence.
    $nucleosomesHTML = new queue(); # Stores each nucelosome's HTML block.
    $nucleosomes = []; # Two dimensional array that will contain the name number and the nucelosome ID for each nucleosome. Name Number (counter) : nucleosome id.
    while($queryueryResultow = mysqli_fetch_array($queryueryResult)){
      $nid = $queryueryResultow[2];
      $html = '<div class="strip redPurple floatAesthetic">'; # $html contain's this nucleosome's HTML block.
      $counter++;
      $html .= '<p class="text"><b>Nucleosome '.$counter.'</b><p><br><hr>'; # Print the next nucleosome number in the sequence.
      $dnaSequence = mysqli_fetch_array(mysqli_query($db, "SELECT DNASequence FROM nucleosomednasequence WHERE ndsid=".$queryueryResultow[1]))[0];
      $allDNA = $allComponents->read("allDNA"); # Concatenated nucleosome's DNA to total DNA.
      $allDNA .= $dnaSequence;
      $errorCode = $allComponents->editValue("allDNA", $allDNA); # Store in the dictionary.
      $html .= '<p class="text"><em>DNA Sequence:</em><br>'.$dnaSequence.'</p><p class="text"><em>Histone Mods:</em><br>';
      $messageods = explode(",", $queryueryResultow[0]);
      for($i=0;$i<count($messageods);$i++){
        $messageod = (int)$messageods[$i]; # Select the current histone modification ID (hmid).
        $messageodName = mysqli_fetch_array(mysqli_query($db, "SELECT name FROM histonemods WHERE hmid=".$messageod))[0]; # Select the histone modification name
        $final = $messageodName;
        $value = $i <=> (count($messageods)-2); # Returns -1 if $i is less than count($messageods)-1, 0 if equal two or 1 if greater than. This is called the spaceship operator.
        if($value == -1){ # Concatenate a comma if this ISN'T the last mod in the sequence.
          $final .= " , ";
        }
        $html .= $final;
      }
      if($uid == $ownerid){ # Checks to see if the user owns this sequence.
        $html .= '<form action="index.php?page=tool&sequence='.$nsid.'" method="post"><input name="nidTD" type="hidden" value="'.$nid.'"/><input name="submitTD" class="removeDeleteButton" type="submit" value="Delete" onfocus="selected(this);" onblur="deselected(this);"/></form>';
        # Displays the form for deleting a nucleosome from the sequence if the user owns this sequence.
      }
      $allMods = $allComponents->read("allHistoneModifications"); # Concatenates retrived histone modifications.
      $allMods .= $queryueryResultow[0];
      $errorCode = $allComponents->editValue("allHistoneModifications", $allMods); #And updates the dictionary.
      $html .= '</div><br><br>';
      $nucleosomesHTML->append($html);
      array_push($nucleosomes, [$counter, $nid]); # Append the array.
    }
    $queryueryResult = mysqli_query($db, "SELECT disease.did, disease.name FROM disease INNER JOIN nucelosomesequence ON disease.did=nucelosomesequence.did WHERE nsid=$nsid"); # Selects the disease associated with the sequence if such a relationship exists.
    $queryueryResultow = mysqli_fetch_array($queryueryResult);
    $did = $queryueryResultow[0]; # Fetch the disease ID.
    $diseaseName = "";
    if($queryueryResult){ # If the sequence is related to a disease, fetch the disease's name.
      $diseaseName = $queryueryResultow[1];
    }
    $messageodsArray = explode(",", $allComponents->read("allHistoneModifications"));
    echo($allComponents->read("allDNA"));
    $hmiResult = interpretHistoneModSequence($messageodsArray, $db); # Determine the change in expression of the DNA sequence at hand.
    if($hmiResult > 0){ # If the overall change in expression activates the expression, display this to the user using the + sign.
      $hmiResult = "+".$hmiResult;
    }

    foreach($allComponents->readAll() as $u){
      echo($u);
    }

    if($queryueryResult){ # Only display a disease association of one exists.
      echo('<div class="strip greenYellow floatAesthetic" onclick="window.location.href=`index.php?page=tool&disease='.$did.'`"><p class="text">This sequence is derived from: <b>'.$diseaseName.'</b></p></div><br><br>');
    }
    echo('<div class="strip greenYellow floatAesthetic"><p class="text"><b>Overall</b></p><p class="text"><em>Full DNA Sequence: <br></em>'.$allComponents->read("allDNA").'</p><p class="text"><em>Expression Change Result: <br></em>'.$hmiResult.'</p><br><p class="text"><em>Notes: </em><br>'.$notes.'</p></div><br><br>');
    # This must be printed first before everthing else so that it stays at the top of the page. It displays data specific to the overall sequence.
    # === Now print the breakdown of the sequence.
    do {
      echo($nucleosomesHTML->get());
      $nucleosomesHTML->pop();
    } while($nucleosomesHTML->isEmpty() == FALSE);
    # ===
    if($uid == mysqli_fetch_array(mysqli_query($db, "SELECT uid FROM nucelosomesequence WHERE nsid=$nsid"))[0] || $admin == TRUE){ # Editing for owner and admin only.
      if($notes == ""){
        $notes = isset($trim["notesTEO"]) ? $trim["notesTEO"] : "Notes"; # Determine the default value of the notes using the tenary operator.
      }
      echo ('<form id="toolForm" class="orangeBlue floatingAesthetic" action="index.php?page=tool&sequence='.$nsid.'" method="post"><p class="text">Edit Overall Details</p><br><br><select name="diseaseAssociationTEO">'); # Start displaying the edit form for the overall sequence.
      if($did){ # If the disease-sequence relationship exists, set that to be the first option in the drop down input.
        echo('<option selected="selected" value="'.$did.'">'.$diseaseName.'</option>');
        $query = "SELECT did, name FROM disease WHERE did!=$did"; # Then fetch all diseases that are not the disease just displayed.
      }
      else { # Print all diseases in alphabetical order.
        $query = "SELECT did, name FROM disease ORDER BY name DESC";
      }
      global $query; # Get the query we just determiend.
      echo('<option value="NULL">No association</option>'); # Display No association as the second/first option depending on whether a disease association already existed or not.
      $queryueryResult = mysqli_query($db, $query);
      while($queryueryResultow = mysqli_fetch_array($queryueryResult)){ # Print each remaining/all diseases as options for the disease association of the sequence depending on whether a disease association already existed or not.
        echo('<option value="'.$queryueryResultow[0].'">'.$queryueryResultow[1].'</option>');
      }
      echo('</select><textarea name="notesTEO" info="Notes" onfocus="clearValue(this); selected(this);" onblur="restoreValue(this); deselected(this);">'.$notes.'</textarea>');
      echo('<input name="nameTEO" type="text" value="'.$name.'" info="Name" onfocus="clearValue(this); selected(this);" onblur="restoreValue(this); deselected(this);"/>');
      echo('<input type="hidden" name="submittedTEO" value="TRUE"/><input type="submit"" name="submitTEO" value="Edit" onfocus="selected(this);" onblur="deselected(this);"/></form>');
      # Display the rest of the form with the deault values determined earlier.
      echo('<form id="toolForm" class="orangeBlue floatingAesthetic" action="index.php?page=tool&sequence='.$nsid.'" method="post"><p class="text">Edit</p><br><br><select name="nucleosomeTE" onfocus="selected(this);" onblur="deselected(this);"><option value="NULL">New nucleosome</option>');
      # Begin displaying the nucleosome-specific edit form.
      foreach($nucleosomes as $n){ # Print each nuclesome as an option to edit. Before we printed an option to create a new nucleosome.
        echo('<option value="'.$n[1].'"> Nucleosome '.$n[0].'</option>');
      }
      $dnaTE = isset($trim["dnaSequenceTE"]) ? $trim["dnaSequenceTE"] : "ATCG";
      $messageodsStrTE = isset($trim["histoneModsTE"]) ? $trim["histoneModsTE"] : "";
      $viewingModsTE = "";
      $messageods = explode(",", $messageodsStrTE);
      foreach($messageods as $messageod){
        $name = mysqli_fetch_array(mysqli_query($db, "SELECT name FROM histonemods WHERE hmid=".intval($messageod)))[0];
        $viewingModsTE .= $name." ";
      }
      echo('</select><textarea id="dnaSequenceTE" name="dnaSequenceTE" maxlength="127" info="ATCG" onkeydown="dnaInputCheck(this);" onfocus="clearValue(this); selected(this);" onblur="restoreValue(this); deselected(this);">'.$dnaTE.'</textarea><br><br><div id="hmodBg"><div id="hmodSequenceTE" class="toolCon">'.$viewingModsTE.'</div></div><br><br>');
      echo('<div id="histoneModDiv"><div class="toolCon"><div id="removeHistoneBtnTE" class="button histoneMod" onclick="removeLastHmod(`hmodSequenceTE`, `histoneModsTE`);">Remove</div>');
              $query = "SELECT hmid, name FROM histonemods";
              $queryueryResult = mysqli_query($db, $query);
              while($queryueryResultow = mysqli_fetch_array($queryueryResult)){
                echo('<div class="button histoneMod" onclick="addHmod(`'.$queryueryResultow[1].'`, `'.$queryueryResultow[0].'`, `hmodSequenceTE`, `histoneModsTE`);">'.$queryueryResultow[1].'</div>');
              }
      echo('</div></div><input id="histoneModsTE" name="histoneModsTE" type="hidden" value="'.$messageodsStrTE.'"/>');
      echo('<input type="submit" name="submitTE" value="Edit"/><input type="hidden" name="submittedTE" value="TRUE"/>');
    }
    echo("';</script>");
  }
  else if(isset($_GET["disease"])){ # If we are retriving the data on a specific disease.
    echo("<script>document.getElementById('toolSingleViewPageContent').innerHTML='");
    $did = $_GET["disease"]; # Fetch the ID of the disease from the URL query.
    $queryueryResultow = mysqli_fetch_array(mysqli_query($db, "SELECT name, notes, uid FROM disease WHERE did=$did"));
    $name = $queryueryResultow[0];
    $notes = $queryueryResultow[1];
    if(is_null($notes)){
      $notes = isset($trim["notesTEO"]) ? $trim["notesTEO"] : "Notes";
    }
    $ownerid = $queryueryResultow[2];
    echo('<br><div class="strip greenYellow floatAesthetic"><p class="text"><b>'.$name.'</b></p><br><p>'.$notes.'</p></div><br><br>');
    # Thhe above line displays the overview information on the disease.
    $queryueryResult = mysqli_query($db, "SELECT nsid, name, notes FROM nucelosomesequence WHERE did=$did"); # Fetches all seqeunces associated with this disease.
    while($queryueryResultow = mysqli_fetch_array($queryueryResult)){ # Ieterates through each sequence associated with this disease.
      $nsid = $queryueryResultow[0];
      echo('<div class="strip redPurple floatAesthetic" onclick="window.location.href=`index.php?page=tool&sequence='.$nsid.'`;"><p class="text">'.$queryueryResultow[1].'</p><br><p class="text">'.$queryueryResultow[2].'</p>');
      # Above line displays the currnent sequence.
      if($uid == $ownerid){ # Checks to see if the user owns this sequence.
        echo('<form action="index.php?page=tool&disease='.$did.'" method="post"><input name="nsidTD" type="hidden" value="'.$nsid.'"/><input name="submitTD" class="removeDeleteButton" type="submit" value="Remove" onfocus="selected(this);" onblur="deselected(this);"/></form>');
        # Above line displays a form to remove association of the sequence to the disease.
      }
      echo('</div><br><br>');
    }

    if($uid == $ownerid){ # Editing for owner only.
      # This displays the form for editing the disease, usign default values determined earlier.
      echo ('<form id="toolForm" class="orangeBlue floatingAesthetic" action="index.php?page=tool&disease='.$did.'" method="post"><p class="text">Edit Overall Details</p><br><br>');
      echo('<textarea name="notesTEO" info="Notes" onfocus="clearValue(this); selected(this);" onblur="restoreValue(this); deselected(this);">'.$notes.'</textarea>');
      echo('<input name="nameTEO" type="text" value="'.$name.'" info="Name" onfocus="clearValue(this); selected(this);" onblur="restoreValue(this); deselected(this);"/>');
      echo('<input type="hidden" name="submittedTEO" value="TRUE"/><input type="submit"" name="submitTEO" value="Edit" onfocus="selected(this);" onblur="deselected(this);"/></form>');
    }
    echo("';</script>");
  }
?>
