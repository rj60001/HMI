<?php
	//Thread stuff
	$q = "SELECT tid, subject, uid FROM thread";
	$r = mysqli_query($db, $q);
	echo("<script>document.getElementById('forumPageContent').innerHTML =\"<br><br>");
	while($row = mysqli_fetch_array($r)){
		$fn = mysqli_fetch_array(mysqli_query($db, "SELECT firstName FROM users WHERE uid=".$row[2]))[0];
		echo("<div class='strip' onclick='window.location.href = `index.php?page=forum&thread=$row[0]`;'><div class='stripCon'><a>$row[1]</a><a style='float: right;'> | $fn</a></div></div><br>"); //Each thread displayed.
	}
	echo("\";</script>");
?>
