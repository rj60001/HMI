<?php
	function convert($m) { # Converts artificial mark-up to HTML.
		$chars = ['[i]', '[/i]', '[b]', '[/b]', '[l]', '[/l]', '[li]', '[/li]']; # All of thw artificial mark up tags.
		$replaceChars = ['<em>', '</em>', '<b>', '</b>', '<ul>', '</ul>', '<li>', '</li>']; # HTMl tags.
		for($i=0;$i<count($chars);$i++){
			$m = str_replace($chars[$i], $replaceChars[$i], $m);
			# Replace any sub-string within the message $m, that matches the artifical mark up tag, with the actual HTML mark up. DO this for each artificial mark up tag.
		}
		return $m;
	}

	# Displays all threads.
	$q = "SELECT tid, subject, uid, dateTime FROM thread ORDER BY dateTime DESC"; # Fetches all threads and order them from newest to oldest to keep the forum relevent to current times.
	$r = mysqli_query($db, $q);

	$num = mysqli_num_rows($r); # Gets the number of rows that were returned.

	echo("<script>document.getElementById('forumPageContent').innerHTML =\"<br><br>"); # Print some javascript that executes once the page has loaded. This javascript prints out HTML mark-up.
	if($num < 1){ # If no threads exist, display a message to indicate this to the user.
		echo("Nothing here! Try posting a new thread by clicking on the 'write' icon at the bottom of the bar.");
	}
	else {
		$threads = new queue($num); # Create a new thread object.

		# Note that the order of the array that is reutrned by mysqli_fetch_array is in the order of the table attributes specified in the query, or in the order of the attributes of the table if they are not specified in the query.
		while($row = mysqli_fetch_array($r)){ # For each thread.
			$fn = mysqli_fetch_array(mysqli_query($db, "SELECT firstName FROM users WHERE uid=".$row[2]))[0]; #  Get the first name of the user who posted it.
			$s = $row[1]; # Fetches the subject of the thread.
			if(strlen($s) > 25){ # This makes sure that only a set amount of the subject text is printed so as not to overflow the strip.
				$s = substr($s, 0, 25)."...";
			}
			$html = "<div class='strip greenYellow floatAesthetic' onclick='window.location.href = `index.php?page=forum&thread=$row[0]`;'><a>$s</a><hr><br><a style='float: right;'>$fn at ".$row[3]." GMT</a>";
			# Each thread displayed as a strip with a link to the forum sing view so that we can view a single thread.
			if($admin == TRUE){ # If the user is an admin, they should have the power to delete inappropriate threads. Display a form to do that.
				$html .= "<form action='".$_SERVER["REQUEST_URI"]."' method='post'><input name='deleteTid' type='hidden' value='".$row[0]."'/><input class='removeDeleteButton' type='submit' value='Delete'/></b></form>";
			}
			$html .= "</div><br>";
			$threads->append($html); # Adds the HTML markup as an element to the back of the queue.
		}

		do {
			echo($threads->get()); # Display the element at the front of the queue.
			$threads->pop(); # Remove that that element.
		} while ($threads->isEmpty() == FALSE); # Repeat until the queue is empty.
	}
	echo("\";</script>");
	# ---

	if(isset($_GET["thread"]) && isset($_COOKIE["user"])){ # If we are in are viewing a single thread on forumSingleViewPage.
		$tid = $_GET["thread"]; # Get the thread id.
		$r = mysqli_query($db, "SELECT mid FROM message WHERE tid = ".$tid); # Select all messages
		$num = mysqli_num_rows($r); # Find the number of returned rows for part of the length of the queue.
		while($mid = mysqli_fetch_array($r)[0]){
			$num += mysqli_num_rows(mysqli_query($db, "SELECT rid FROM replies WHERE mid = ".$mid)); # Adds the number of replies for each number to the total length of the queue.
		}

		$posts = new queue($num+1); # This will contain the html with the original post first, then each message followed by their replies in order of oldest to newest. We add one to the queue length to account for the original post.

		echo("<script>menuBtnClick('forumSingleView'); document.getElementById('forumSingleViewPageContent').innerHTML=`"); # Begin the JavaScript script.
		$r = mysqli_query($db, "SELECT subject, message, firstName, dateTime FROM thread INNER JOIN users ON thread.uid = users.uid WHERE tid=".$tid); # Fetch the original post of the thread and the user's first name who psoetd it.
		$rowT = mysqli_fetch_array($r); # Store the extracted data in an array.
		$m = convert($rowT[1]); # Converts artificial mark up to valid HTML in the message.
		$OPHTML = "<br><br><div class='forumObj greenYellow floatAesthetic'><div class='forumCon'><b>$rowT[0]</b><br><t>$m</t><br><em class='forumNameTag'>$rowT[2] at $rowT[3] GMT</em></div></div>"; # Displays the original post.

		$posts->append($OPHTML);

		$r = mysqli_query($db, "SELECT message, firstName, mid, dateTime FROM message INNER JOIN users ON message.uid = users.uid WHERE tid=".$tid); # Fetch data on all messages to the original post including the first name of the use who posted it.
		while($rowM = mysqli_fetch_array($r)){ # For each message.
			$m = convert($rowM[0]); # Retrive the message body.
			$mHTML = "<br><div class='forumObj message redPurple floatAesthetic'><div class='forumCon' onclick='document.getElementById(\"replyingPU\").style.display = \"block\"; document.getElementById(\"midPR\").value = \"".$rowM[2]."\";'><div><t>$m</t><br><em class='forumNameTag'>$rowM[1] at $rowM[3] GMT</em></div>";
			# The above line displays the message.
			if($admin == TRUE){ # Dispaly a form to delete the message if the user is an admin.
				$mHTML .= '<form action="'.$_SERVER['REQUEST_URI'].'" method="post"><input name="deleteMid" type="hidden" value="'.$rowM[2].'"/><input class="removeDeleteButton" type="submit" value="Delete" onclick="document.getElementById(\'replyingPU\').style.display = \'none\';"/></b></form>';
			}
			$mHTML .= "</div></div><br>";
			$posts->append($mHTML);
			$rR = mysqli_query($db, "SELECT message, firstName, rid, dateTime FROM replies INNER JOIN users ON replies.uid = users.uid WHERE replies.mid=".$rowM[2]); # Fetch all the repleis foreach message, aswell as the firstname of the suer who posted it.
			while($rowR = mysqli_fetch_array($rR)){
				$m = convert($rowR[0]);
				$rHTML = "<div class='forumObj reply orangeBlue floatAesthetic'><div class='forumCon'><t>$m</t><br><em class='forumNameTag'>".$rowR[1]." at ".$rowR[3]." GMT</em>";
				#Display the reply.
				if($admin == TRUE){ # Dispaly a form to delete the repy if the user is an admin.
					$rHTML .= '<form action="'.$_SERVER['REQUEST_URI'].'" method="post"><input name="deleteRid" type="hidden" value="'.$rowR[2].'"/><input class="removeDeleteButton" type="submit" value="Delete"/></b></form>';
				}
				$rHTML .= "</div></div><br>";
				$posts->append($rHTML);
			}
		}

		do {
			echo($posts->get()); # Print the post
			$posts->pop(); # Remove it from the queue.
		} while($posts->isEmpty() == FALSE); # Repeat until the queue is empty.
		echo("<br><br>`;</script>"); # End the JavaScript script.
	}
?>
