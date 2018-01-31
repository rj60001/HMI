<?php
  if(isset($_COOKIE["user"])){ # Only display the page if the user has signed in.
    # For searching through forum posts and sequences. selected="selected" is used instead of just selected as it is XHTML compliant. This also indicated the default option of select.
    $search = isset($trim["searchValue"]) ? $trim["searchValue"] : "Search"; # Get the previously entered value searched for if the user has searched before. Otherwise set toa  defualt value.
    $searchType = isset($trim["searchType"]) ? $trim["searchType"] : "";
    echo('<script>document.getElementById("searchFormCon").innerHTML=`'); # Start the JavaScript script.
    echo('<form id="searchBoxForm" action="index.php?page=search" method="post">
      <div id="inputsCon">
        <select id="searchType" name="searchType" class="redPurple floatAesthetic">'); # Begin displaying the search form.
    $optionKeyValues = ['currentUserSequences', 'My sequences', 'currentUserDiseases', 'My diseases', 'currentUserThreads', 'My threads', 'sequences', 'All sequences', 'diseases', 'All diseases', 'threads', 'All theads'];
    # Above line creates an array that holds the value (the key) and the actual text (the value) displayed to the user, for each user in the respective format. E.g. w, x, y, z where w is a value and x is a peice of text and w,x and y,z are pairs of values.
    $optionDictionary = new dictionary($optionKeyValues); # Create a dictionary object using the constructor defined in dictionary.php and the array previosuly defined.
    if($searchType != ""){ # If the user has entered a search term before, display that as the default type of search to be conducted.
      $submittedValue = $optionDictionary->read($searchType); # Gets the text to display to the user.
      echo('<option value="'.$searchType.'" selected="selected">'.$submittedValue.'</option>'); # Prints the option.
      $result = $optionDictionary->remove($searchType); # Removes the option from the dictionary so it is not reprinted.
    }
    $optionKeys = $optionDictionary->keys; # Fetches all keys from the dictionary.
    for($i=0;$i<count($optionKeys);$i++){ # For each key.
      $currentKey = $optionKeys[$i];
      $currentValue = $optionDictionary->read($currentKey); # Fetch the value associated with that key.
      echo('<option value="'.$currentKey.'">'.$currentValue.'</option>'); # Print the option.
    }
    echo('</select>
        <input id="searchBox" name="searchValue" class="redPurple floatAesthetic" type="text" value="'.$search.'" info="Search" onfocus="clearValue(this); selected(this);" onblur="restoreValue(this); deselected(this);"/>
        <input id="searchBtn" class="redPurple floatAesthetic" type="submit"/>
      </div>
      <input name="page" value="tool" type="hidden"/>
    </form><br><br><br><br>'); # Print the rest of the form. $search holds the default value of the search term input.
    echo('`;</script>'); # End the JavaScript script.
  }
?>
