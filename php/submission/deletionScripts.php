<?php
  if(isset($trim["deleteNsid"])){
    $nsid = $trim["deleteNsid"]; # Fetch ID for the nucleosome sequence from the form.
    $r = mysqli_query($db, "DELETE FROM nucelosomesequence WHERE nsid=$nsid"); # Delete the row that contaisn this id from the database
  }
  else if(isset($trim["deleteDid"])){
    $did = $trim["deleteDid"]; # Fetch ID for the disease from the form.
    $r = mysqli_query($db, "DELETE from disease WHERE did=$did"); # Delete this disease row from the database using the ID.
  }

  # All forum deleting stuff is handled in submission/forum.php
?>
