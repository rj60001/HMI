<?php
  if(isset($trim["deleteNsid"])){
    $nsid = $trim["deleteNsid"]; # Fetch ID for the nucleosome sequence from the form.
    $r = mysqli_query($db, "DELETE FROM nucelosomesequence WHERE nsid=$nsid"); # Delete the row that contaisn this id from the database
  }
  else if(isset($trim["deleteDid"])){
    $did = $trim["deleteDid"]; # Fetch ID for the disease from the form.
    $r = mysqli_query($db, "DELETE FROM disease WHERE did=$did"); # Delete this disease row from the database using the ID.
  }
  else if(isset($trim["nidTD"]) && isset($_GET["sequence"])){
    $nid = $trim["nidTD"];
    $r = mysqli_query($db, "DELETE FROM nucleosome WHERE nid=$nid");
    echo('<script>window.location.href="index.php?page=tool&sequence='.$nsid.'";</script>');
  }

  # All forum deleting stuff is handled in submission/forum.php
?>
