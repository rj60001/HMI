<?php
  if(isset($_COOKIE["user"])){ # Only display these forums if the user has lopgged in.
    # For searching through forum posts and sequences. selected="selected" is used instead of just selected as it is XHTML compliant. This also indicated the default option of select.
    $search = isset($trim["searchValue"]) ? $trim["searchValue"] : "Search";
    $searchType = isset($trim["searchType"]) ? $trim["searchValue"] : "";
    $optionsValues = ['currentUserSequences', 'currentUserThreads', 'currentUserDiseases', 'sequences', 'diseases', 'threads'];
    $options = ['My sequences', 'My threads', 'My diseases', 'All sequences', 'All diseases', 'All threads'];
    echo('<script>document.getElementById("searchFormCon").innerHTML=`');
    echo('<form id="searchBoxForm" action="index.php?page=search" method="post">
      <div id="inputsCon">
        <select id="searchType" name="searchType" class="redPurple floatAesthetic">');
    $pos = array_search($searchType, $optionsValues);
    if($searchType != ""){
      echo('<option value="'.$searchType.'">'.$options[$pos].'</option>');
    }
    array_splice($options, $pos, 1);
    array_splice($optionsValues, $pos, 1);
    for($i=0;$i<count($options);$i++){
      echo('<option value="'.$optionsValues[$i].'">'.$options[$i].'</option>');
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
