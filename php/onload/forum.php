<?php
	function convert($m) { //Converts artificial mark-up to HTML.
		$chars = ['[i]', '[/i]', '[b]', '[/b]', '[l]', '[/l]', '[li]', '[/li]'];
		$replaceChars = ['<em>', '</em>', '<b>', '</b>', '<ul>', '</ul>', '<li>', '</li>'];
		for($i=0;$i<count($chars);$i++){
			$m = str_replace($chars[$i], $replaceChars[$i], $m);
		}
		return $m;
	}

	# Thread stuff
	$q = "SELECT tid, subject, uid, dateTime FROM thread ORDER BY tid DESC";
	$r = mysqli_query($db, $q);
	echo("<script>document.getElementById('forumPageContent').innerHTML =\"<br><br>");
	while($row = mysqli_fetch_array($r)){
		$fn = mysqli_fetch_array(mysqli_query($db, "SELECT firstName FROM users WHERE uid=".$row[2]))[0];
		$s = $row[1];
		if(strlen($s) > 25){ # This makes sure that only a set amount of the subject text is printed so as not to overspill the strip.
			$s = substr($s, 0, 25)."...";
		}
		echo("<div class='strip greenYellow floatAesthetic' onclick='window.location.href = `index.php?page=forum&thread=$row[0]`;'><a>$s</a><hr><br><a style='float: right;'>$fn at ".$row[3]."</a>"); //Each thread displayed.
		if($admin == TRUE){
			echo("<form action='".$_SERVER["REQUEST_URI"]."' method='post'><input name='deleteTid' type='hidden' value='".$row[0]."'/><input class='removeDeleteButton' type='submit' value='Delete'/></b></form>");
		}
		echo("</div><br>");
	}

	if(mysqli_num_rows($r) < 1){
		echo("Nothing here! Try posting a new thread by clicking on the 'write' icon at the bottom of the bar.");
	}
	echo("\";</script>");

	if(isset($_GET["thread"]) && isset($_COOKIE["user"])){
		echo("<script>menuBtnClick('forumSingleView'); document.getElementById('forumSingleViewPageContent').innerHTML=`");
		$tid = $_GET["thread"];
		$r = mysqli_query($db, "SELECT subject, message, firstName, dateTime FROM thread INNER JOIN users ON thread.uid = users.uid WHERE tid=".$tid);
		$rowT = mysqli_fetch_array($r);
		$m = convert($rowT[1]);
		echo("<br><br><div class='forumObj greenYellow floatAesthetic'><div class='forumCon'><b>$rowT[0]</b><br><t>$m</t><br><em class='forumNameTag'>$rowT[2] at $rowT[3]</em></div></div>");
		$r = mysqli_query($db, "SELECT message, firstName, mid, dateTime FROM message INNER JOIN users ON message.uid = users.uid WHERE tid=".$tid);
		while($rowM = mysqli_fetch_array($r)){
			$m = convert($rowM[0]);
			echo("<br><div class='forumObj message redPurple floatAesthetic'><div class='forumCon' onclick='document.getElementById(\"replyingPU\").style.display = \"block\"; document.getElementById(\"midPR\").value = \"".$rowM[2]."\";'><div><t>$m</t><br><em class='forumNameTag'>$rowM[1] at $rowM[3]</em></div>");
			if($admin == TRUE){
				echo('<form action="'.$_SERVER['REQUEST_URI'].'" method="post"><input name="deleteMid" type="hidden" value="'.$rowM[2].'"/><input class="removeDeleteButton" type="submit" value="Delete" onclick="document.getElementById(\'replyingPU\').style.display = \'none\';"/></b></form>');
			}
			echo("</div></div>");
			$rR = mysqli_query($db, "SELECT message, firstName, rid, dateTime FROM replies INNER JOIN users ON replies.uid = users.uid WHERE replies.mid=".$rowM[2]);
			while($rowR = mysqli_fetch_array($rR)){
				$m = convert($rowR[0]);
				echo("<br><div class='forumObj reply orangeBlue floatAesthetic'><div class='forumCon'><t>$m</t><br><em class='forumNameTag'>".$rowR[1]." at ".$rowR[3]."</em>");
				if($admin == TRUE){
					echo('<form action="'.$_SERVER['REQUEST_URI'].'" method="post"><input name="deleteRid" type="hidden" value="'.$rowR[2].'"/><input class="removeDeleteButton" type="submit" value="Delete"/></b></form>');
				}
				echo("</div></div><br>");
			}
		}
		echo("<br><br>`;</script>");
	}
?>
