<?php
  if(isset($_COOKIE["user"])){ # If the user is signed in, we can display the page.
    $dna = isset($trim["dnaSequenceT"]) ? $trim["dnaSequenceT"] : "ATCG"; # Keep DNA sequence if previous submitted.
    $modsStr = isset($trim["histoneModsT"]) ? $trim["histoneModsT"] : ""; # Keep histone mod sequence if previously submitted.
    $viewingMods = "";
    $mods = explode(",", $modsStr); # Create an array of mods.
    foreach($mods as $mod){
      $name = mysqli_fetch_array(mysqli_query($db, "SELECT name FROM histonemods WHERE hmid=".intval($mod)))[0]; # Feth the name of each mode.
      $viewingMods .= $name." "; # Thne concatenate it to the display string.
    }
    $nameS = isset($trim["sequenceNameT"]) ? $trim["sequenceNameT"] : "Name";
    $notes = isset($trim["notesT"]) ? $trim["notesT"] : "Notes";
    $nameD = isset($trim["sequenceNameD"]) ? $trim["sequenceNameD"] : "Disease name";
    $notesD = isset($trim["notesD"]) ? $trim["notesD"] : "Notes";
    echo('<script>document.getElementById("toolPageContent").innerHTML=`'); # Begin the Java Script Script.
    echo('<p class="subTitle">Tool</p>
          <p class="text">This is the tool page. Here you can add histone modification sequences to the database on top of any DNA sequence:</p>
          <br>
          <br>
          <form id="diseaseForm" action="index.php?page=tool" method="post" class="redPurple floatAesthetic">
            <p class="text">Use this this mini tool to create a new disease that histone modifications can be associated with.</p>
            <br>
            <br>
            <input name="diseaseNameD" type="text" value="'.$nameD.'" info="Disease name" onfocus="clearValue(this); selected(this);" onblur="restoreValue(this); deselected(this);"/>
            <textarea name="notesD" info="Notes" onfocus="clearValue(this); selected(this);" onblur="restoreValue(this); deselected(this);">'.$notesD.'</textarea>
            <input name="submitD" type="submit" value="Create" class="button large"/>
            <input name="submittedD" type="hidden" value="TRUE"/>
          </form>'); # Display the form for creating a new disease.
     echo('<form id="toolForm" action="index.php?page=tool" method="post" class="greenYellow floatAesthetic">
            <p class="text">Here you can create your own DNA sequence and histone modification sequence in  5\'-3\' direction. Note that the tool is still in beta - there is <b>no</b> histone code checking.</p>
            <br>
            <br>
            <textarea id="dnaSequenceT" name="dnaSequenceT" onkeydown="dnaInputCheck(this);" info="ATCG" onfocus="clearValue(this); selected(this);" onblur="restoreValue(this); deselected(this);">'.$dna.'</textarea>
            <br>
            <br>
            <div id="hmodBg"><div id="hmodSequence" class="toolCon">'.$viewingMods.'</div></div>
            <br>
            <br>
            <div id="histoneModDiv">
              <div class="toolCon">
              <div id="removeHistoneBtn" class="button histoneMod" onclick="removeLastHmod();">Remove</div>
              <div class="button histoneMod" onclick="split();">Next Histone</div>
              '); # Display the first part of the tool form, using the default values determined earlier for the inputs.
              $q = "SELECT hmid, name FROM histonemods"; # Select the name and id of each histone modification in the database
              $r = mysqli_query($db, $q);
              while($row = mysqli_fetch_array($r)){ # For each histone modification.
                $name = $row[1];
                echo('<div class="button histoneMod" onclick="addHmod(\''.$name.'\', \''.$row[0].'\');">'.$name.'</div>');
                # The above line displays a button that the user can click on to append a mod to the sequence of modfications.
              }
              echo('</div>
            </div>
            <br><br>
            <input name="sequenceNameT" class="large" type="text" value="'.$nameS.'" info="Name" onfocus="clearValue(this); selected(this);" onblur="restoreValue(this); deselected(this);"/>
            <select name="diseaseAssociationT" class="large">
              <option value="NULL" selected="selected">No disease association</option>'); # Display
      $r = mysqli_query($db, "SELECT * FROM disease ORDER BY name DESC"); # This prints all diseases in alphabetical order so that a sequence can be associated with it one.
      while($row = mysqli_fetch_array($r)){ # Print an option for each disease in the database.
        echo('<option value="'.$row[0].'">'.$row[1].'</option>');
      }
      echo('<select>
            <br><br>
            <input id="histoneModsT" name="histoneModsT" type="hidden" value="'.$modsStr.'"/>
            <textarea class="lowercase" name="notesT" info="Notes" onfocus="clearValue(this); selected(this);" onblur="restoreValue(this); deselected(this);">'.$notes.'</textarea>
            <input name="submitT" type="submit" value="Query" class="button large"/>
            <input name="submittedT" type="hidden" value="TRUE"/>
          </form><br><br>'); # Print out the rest of the form.
      echo('`;</script>');
      # Only the histoneModsT element is submitted as the histoen mods component of the form. NOT hmodSequence.
  }

  if(isset($_GET["diseaseSubmitted"])){ # Display out a confirmation if a new disease has been added to the databsee.
    echo($popupTop.'<p>Disease has now been submitted. You can now add new sequences to that disease.</p>'.$popupBottom);
  }
  else if(isset($_GET["sequenceSubmitted"])){ # Display out a confirmation if a new sequence has been added to the database.
    echo($popupTop."<p>Your sequence has now been submitted. Navigate to your sequences to view its results.</p>".$popupBottom);
  }
?>
