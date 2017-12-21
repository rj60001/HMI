<?php
	//Thread stuff
	$q = "SELECT tid, subject, uid FROM thread ORDER BY tid DESC";
	$r = mysqli_query($db, $q);
	echo("<script>document.getElementById('forumPageContent').innerHTML =\"<br><br>");
	while($row = mysqli_fetch_array($r)){
		$fn = mysqli_fetch_array(mysqli_query($db, "SELECT firstName FROM users WHERE uid=".$row[2]))[0];
		$s = $row[1];
		if(count($s) > 25){
			$s = substr($s, 0, 25)."...";
		}
		echo("<div class='strip greenYellow floatAesthetic' onclick='window.location.href = `index.php?page=forum&thread=$row[0]`;'><a>$s</a><a style='float: right;'> | $fn</a>"); //Each thread displayed.
		if($admin == TRUE){
			echo("<form action='".$_SERVER["REQUEST_URI"]."' method='post'><input name='deleteTid' type='hidden' value='".$row[0]."'/><input class='large deleteBtn' type='submit' value='Delete'/></b></form>");
		}
		echo("</div><br>");
	}
	echo("\";</script>");
?>
