<?php
  if(isset($_GET["diseaseSubmitted"])){ # Display out a confirmation if a new disease has been added to the `disease` table.
    echo($popupTop.'<p>Disease has now been submitted. You can now add new sequences to that disease.</p>'.$popupBottom);
  }
  else if(isset($_GET["sequenceSubmitted"])){
    echo($popupTop."<p>Your sequence has now been submitted. Navigate to your sequences to view its results.</p>".$popupBottom);
  }
?>
