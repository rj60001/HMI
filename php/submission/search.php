<?php
  if(isset($trim["searchValue"]) && isset($trim["searchType"])){
    $sv = $trim["searchValue"]; # This contains the text that the user is actually searching for.
    $st = $trim["searchType"]; # This tells us what filter to apply to the search.
    if($sv == "Search"){ # We cannot search for the text 'Search'.
      $sv = ""; # This sets the value so that it lists all records.
    }

    $q = "";
    switch($st){ # This is used to determine which query to process based on the filter. % is a wildcard character.
      case "threads":
        $q = "SELECT tid, subject, firstName FROM thread INNER JOIN users ON thread.uid=users.uid WHERE subject LIKE '%$sv%' OR message LIKE '%".$sv."%' ORDER BY tid DESC";
        break;
      case "sequences":
        $q = "SELECT nsid, name, firstName FROM nucelosomesequence INNER JOIN users ON nucelosomesequence.uid=users.uid WHERE name LIKE '%".$sv."%'";
        break;
      case "diseases":
        $q = "SELECT did, disease.name FROM disease INNER JOIN nucelosomeSequence ON disease.did=nucleosomeSequence.did WHERE disease.name LIKE '%".$sv."%'";
        break;
      case "currentUserSequences":
        $q = "SELECT nsid, name, firstName FROM nucelosomesequence INNER JOIN users ON nucelosomesequence.uid=users.uid WHERE users.uid=$uid AND name LIKE '%".$sv."%'";
        break;
      case "currentUserThreads":
        $q = "SELECT tid, subject, firstName FROM thread INNER JOIN users ON thread.uid=users.uid WHERE subject LIKE '%$sv%' OR message LIKE '%".$sv."%' AND users.uid=".$uid." ORDER BY tid DESC";
        break;
      default:
        $errors = ["No search type indicated."];
        break;
    } # All queries will return records created by the user. The 'currentUser' queries return only records created by the current user.

    $r = mysqli_query($db, $q);
    echo("<script>document.getElementById('searchResultsCon').innerHTML=\"");
    if(mysqli_num_rows($r) >= 1){
      while($row = mysqli_fetch_array($r)){
        if($st == ("threads" || "currentUserThread")){ # Searching for threads.
          $s = $row[1];
          if(count($s) > 25){
            $s = substr($s, 0, 25)."...";
          }
          # This displays the results of the retrived records, when one is clicked it will redirect to a page displaying all of the records='s information.'
          echo("<div class='strip greenYellow floatAesthetic' onclick='window.location.href = `index.php?page=forum&thread=".$row[0]."`;'><a>$s</a><a style='float: right;'> | ".$row[2]."</a>"); # Each thread displayed.
          if($admin == TRUE){
            echo("<form action='".$_SERVER["REQUEST_URI"]."' method='post'><input name='deleteTid' type='hidden' value='".$row[0]."'/><input class='large deleteBtn' type='submit' value='Delete'/></b></form>");
          }
          echo("</div><br>");
        }
        else if($st == ("sequences" || "currentUserSequences")){ # Searching for histone modification sequences.
          # This displays the results of the retrived records, when one is clicked it will redirect to a page displaying all of the records='s information.'
          echo("<div class='strip greenYellow floatAesthetic' onclick='window.location.href = `index.php?page=forum&thread=".$row[0]."`;'><a>$row[1]</a><a style='float: right;'> | ".$row[2]."</a>"); # Each thread displayed.
          if($admin == TRUE){
            echo("<form action='".$_SERVER["REQUEST_URI"]."' method='post'><input name='deleteNsid' type='hidden' value='".$row[0]."'/><input class='large deleteBtn' type='submit' value='Delete'/></b></form>");
          }
          echo("</div><br>");
        }
        else { # If we are searching all diseases. Else can only be this as any other value of $st is a logical error.
          echo("<div class='strip greenYellow floatAesthetic' onclick='window.location.href = `index.php?page=forum&thread=".$row[0]."`;'><a>".$row[1]."</a></a>"); //Each thread displayed.
          if($admin == TRUE){
            echo("<form action='".$_SERVER["REQUEST_URI"]."' method='post'><input name='deleteDid' type='hidden' value='".$row[0]."'/><input class='large deleteBtn' type='submit' value='Delete'/></b></form>");
          }
          echo("</div><br>");
        }
      }
    }
    else {
      echo("No results.");
    }
    echo("\";</script>");
  }
?>
