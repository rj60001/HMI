<?php
  if(isset($trim["searchValue"]) && isset($trim["searchType"])){
    $sv = $trim["searchValue"]; # This contains the text that the user is actually searching for.
    $st = $trim["searchType"]; # This tells us what filter to apply to the search.
    $errors = [];
    if($sv == "Search"){ # We cannot serahc for the text 'Search'.
      $errors = ["Cannot use default value."];
    }

    $q = "";
    switch($st){ # This is used to determine which query to process based on the filter. % is a wildcard character.
      case "threads":
        $q = "SELECT tid, subject, firstName FROM thread INNER JOIN users ON thread.uid=users.uid WHERE subject=''%$sv%'' OR message='%".$sv."%' ORDER BY tid DESC";
        break;
      case "sequences":
        $q = "SELECT nsid, name FROM nucleosomesequence WHERE name='".$sv."'";
        break;
      case "diseases":
        $q = "SELECT did, disease.name FROM disease INNER JOIN nucleosomeSequence ON disease.did=nucleosomeSequence.did WHERE disease.name='%".$sv."%'";
        break;
      case "currentUserSequences":
        $q = "SELECT nsid, name FROM nucleosomesequence WHERE uid=$uid AND name='".$sv."'";
        break;
      case "currentUserThreads":
        $q = "SELECT tid, subject, message, firstName FROM thread INNER JOIN users ON thread.uid=users.uid WHERE subject=''%$sv%'' OR message='%".$sv."%' AND thread.uid=".$uid." ORDER BY tid DESC";
        break;
      default:
        $errors = ["No search type indicated."];
        break;
    } # All queries will return records created by the user. The 'currentUser' queries return only records created by the current user.

    if(empty($errors)){
      $r = mysli_query($db, $q);
      while($row = mysqli_fetch_array($r)){
        echo("<script>document.getElementById('searchResultsCon').innerHTML=\'");
        if($st == ("threads" || "currentUserThread")){ # Searching for threads.
          $s = $row[1]
          if(count($s) > 25){
      			$s = substr($s, 0, 25)."...";
      		}
          # This displays the results of the retrived records, when one is clicked it will redirect to a page displaying all of the records='s information.'
          echo("<div class='strip greenYellow floatAesthetic' onclick='window.location.href = `index.php?page=forum&thread=$row[0]`;'><a>$s</a><a style='float: right;'> | $row[3]</a>"); //Each thread displayed.
      		if($admin == TRUE){
      			echo("<form action='".$_SERVER["REQUEST_URI"]."' method='post'><input name='deleteTid' type='hidden' value='".$row[0]."'/><input class='large deleteBtn' type='submit' value='Delete'/></b></form>");
      		}
      		echo("</div><br>");
        }
        else if($st == ("sequences" || "currentUserSequences")){ # Searching for histone modification sequences.

        }
        else { # If we are searching all diseases. Else can only be this as any other value of $st is a logical error.

        }
        echo("\';")
      }
    }
    else {
      echo($popupTop);
      foreach($errors as $error){
        echo("<p>".$error."</p>");
      }
      echo($popupBottom);
    }
  }
?>
