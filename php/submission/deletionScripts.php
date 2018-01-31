<?php
  if(isset($trim["deleteNsid"])){
    $nsid = $trim["deleteNsid"]; # Fetch ID for the nucleosome sequence from the form.
    $r = mysqli_query($db, "DELETE FROM nucelosomesequence WHERE nsid=$nsid"); # Delete the row that contains this id from the database
    echo('<script>window.location.href="index.php?page=search";</script>'); # Redirect to the search page.
  }
  else if(isset($trim["deleteDid"])){
    $did = $trim["deleteDid"]; # Fetch ID for the disease from the form.
    $r = mysqli_query($db, "DELETE FROM disease WHERE did=$did"); # Delete this disease row from the database using the ID.
    echo('<script>window.location.href="index.php?page=search";</script>');
  }
  else if(isset($trim["nidTD"]) && isset($_GET["sequence"])){
    $nid = $trim["nidTD"];
    $r = mysqli_query($db, "DELETE FROM nucleosome WHERE nid=$nid");
    echo('<script>window.location.href="index.php?page=tool&sequence='.$nsid.'";</script>');
    # Redirect to the sequence from which the nucelosome was deleted from to prevent accidental resubmission.
  }

  # All forum deleting stuff is handled in submission/forum.php
?>
