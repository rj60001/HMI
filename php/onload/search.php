<?php
  if(isset($_COOKIE["user"])){ # Only display these forums if the user has lopgged in.
    # For searching through forum posts and sequences. selected="selected" is used instead of just selected as it is XHTML compliant. This also indicated the default option of select.
    $search = isset($trim["searchValue"]) ? $trim["searchValue"] : "Search";
    $searchType = isset($trim["searchType"]) ? $trim["searchType"] : "";
    echo('<script>document.getElementById("searchFormCon").innerHTML=`');
    echo('<form id="searchBoxForm" action="index.php?page=search" method="post">
      <div id="inputsCon">
        <select id="searchType" name="searchType" class="redPurple floatAesthetic">');
    $optionKeyValues = ['currentUserSequences', 'My sequences', 'currentUserDiseases', 'My diseases', 'currentUserThreads', 'My threads', 'sequences', 'All sequences', 'diseases', 'All diseases', 'threads', 'All theads'];
    $optionDictionary = new dictionary($optionKeyValues);
    if($searchType != ""){
      $submittedValue = $optionDictionary->read($searchType);
      echo('<option value="'.$searchType.'">'.$submittedValue.'</option>');
      $result = $optionDictionary->remove($searchType);
    }
    $optionKeys = $optionDictionary->keys;
    for($i=0;$i<count($optionKeys);$i++){
      $currentKey = $optionKeys[$i];
      $currentValue = $optionDictionary->read($currentKey);
      echo('<option value="'.$currentKey.'">'.$currentValue.'</option>');
    }
    echo('</select>
        <input id="searchBox" name="searchValue" class="redPurple floatAesthetic" type="text" value="'.$search.'" info="Search" onfocus="clearValue(this); selected(this);" onblur="restoreValue(this); deselected(this);"/>
        <input id="searchBtn" class="redPurple floatAesthetic" type="submit"/>
      </div>
      <input name="page" value="tool" type="hidden"/>
    </form><br><br><br><br>');
    echo('`;</script>');
  }
?>
