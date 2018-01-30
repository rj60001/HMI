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
        $q = "SELECT * FROM disease WHERE name LIKE '%".$sv."%'";
        break;
      case "currentUserSequences":
        $q = "SELECT nsid, name, firstName FROM nucelosomesequence INNER JOIN users ON nucelosomesequence.uid=users.uid WHERE users.uid=$uid AND name LIKE '%".$sv."%'";
        break;
      case "currentUserThreads":
        $q = "SELECT tid, subject, firstName FROM thread INNER JOIN users ON thread.uid=users.uid WHERE subject LIKE '%$sv%' OR message LIKE '%".$sv."%' AND users.uid=".$uid." ORDER BY tid DESC";
        break;
      case "currentUserDiseases":
        $q = "SELECT * FROM disease WHERE name LIKE '%".$sv."%' AND uid=".$uid;
        break;
      default:
        $errors = ["No search type indicated."];
        break;
    } # All queries will return records created by the user. The 'currentUser' queries return only records created by the current user.
    $r = mysqli_query($db, $q);
    echo("<script>document.getElementById('searchResultsCon').innerHTML=\"");
    if(mysqli_num_rows($r) > 0){ # Only display results if any rows exist from the query.
      while($row = mysqli_fetch_array($r)){
        if($st == "threads" || $st == "currentUserThreads"){ # Searching for threads.
          $s = $row[1];
          if(strlen($s) > 25){
            $s = substr($s, 0, 25)."...";
          }
          # This displays the results of the retrived records, when one is clicked it will redirect to a page displaying all of the records='s information.'
          echo("<div class='strip greenYellow floatAesthetic' onclick='window.location.href = `index.php?page=forum&thread=".$row[0]."`;'><a>$s</a><a style='float: right;'> | ".$row[2]."</a>"); # Each thread displayed.
          if($admin == TRUE){ # Allows admins to delete any thread.
            echo("<form action='".$_SERVER["REQUEST_URI"]."' method='post'><input name='deleteTid' type='hidden' value='".$row[0]."'/><input class='removeDeleteButton' type='submit' value='Delete'/></b></form>");
          }
          echo("</div><br>");
        }
        else if($st == "sequences" || $st == "currentUserSequences"){ # Searching for histone modification sequences.
          # This displays the results of the retrived records, when one is clicked it will redirect to a page displaying all of the records='s information.'
          echo("<div class='strip greenYellow floatAesthetic' onclick='window.location.href = `index.php?page=tool&sequence=".$row[0]."`;'><a>$row[1]</a><a style='float: right;'> | ".$row[2]."</a>"); # Each thread displayed.
          if($uid == mysqli_fetch_array(mysqli_query($db, "SELECT uid FROM nucelosomesequence WHERE nsid=".$row[0]))[0]){ # Alows the user to delete their own sequences but no-one elses.
            echo("<form action='".$_SERVER["REQUEST_URI"]."' method='post'><input name='deleteNsid' type='hidden' value='".$row[0]."'/><input class='removeDeleteButton' type='submit' value='Delete'/></b></form>");
          }
          echo("</div><br>");
        }
        else { # If we are searching diseases. Else can only be this as any other value of $st is an input error.
          echo("<div class='strip greenYellow floatAesthetic' onclick='window.location.href = `index.php?page=tool&disease=".$row[0]."`;'><a>".$row[1]."</a></a>"); //Each thread displayed.
          if($admin == TRUE){ # Allows admins to delete diseases.
            echo("<form action='".$_SERVER["REQUEST_URI"]."' method='post'><input name='deleteDid' type='hidden' value='".$row[0]."'/><input class='removeDeleteButton' type='submit' value='Delete'/></b></form>");
          }
          echo("</div><br>");
        }
      }
    }
    else { # If no results display a message to indicate this.
      echo("No results.");
    }
    echo("\";</script>");
  }
?>
