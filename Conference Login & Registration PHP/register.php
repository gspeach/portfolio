<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Conference Registration</title>
<link rel="stylesheet" type="text/css" href="http://helios.ite.gmu.edu/~gspeach/IT207/style.css" />
</head>
<body>
<?php
		if(isset($_GET["fname"]) && isset($_GET["lname"]) && isset($_GET["address1"]) && isset($_GET["address2"]) && isset($_GET["city"]) && isset($_GET["state"]) && isset($_GET["zip"]) && isset($_GET["phone"]) && isset($_GET["fax"]) && isset($_GET["badge"]) && isset($_GET["password"])){
			$fname = $_GET["fname"];
			$lname = $_GET["lname"];
			$address1 = $_GET["address1"];
			$address2 = $_GET["address2"];
			$city = $_GET["city"];
			$state = $_GET["state"];
			$zip = $_GET["zip"];
			$phone = $_GET["phone"];
			$fax = $_GET["fax"];
			$badge = $_GET["badge"];
			$password = $_GET["password"];
			$login = $fname . $lname;
			$participants= file_get_contents("participants.txt");

			if(empty($_GET["fname"]) || $_GET["state"] == "select" || empty($_GET["lname"]) || empty($_GET["address1"]) || empty($_GET["city"]) || empty($_GET["state"]) || empty($_GET["zip"]) || empty($_GET["phone"]) || empty($_GET["badge"]) || empty($_GET["password"])){
				echo "<p>You must enter a value in each field. Click your browser's back button to return to form.</p>";
				echo "<hr />";
				echo "<p><a href='index.html'>Return to Conference Registration Page</a></p>";
			}
			elseif(strpos($participants,$login) !== FALSE){
				echo "<p>You are already registered!</p>";
				echo "<hr />";
				echo "<p><a href='index.html'>Return to Conference Registration Page</a></p>";
			}
			else{
				$participants = file_get_contents("participants.txt");
				$participantsnew = $participants . "\n" . "*;" . $login . ";" . $password . ";" . $fname . ";" . $lname . ";" . $address1 . ";" . $address2 . ";" . $city . ";" . $state . ";" . $zip . ";" . $phone . ";" . $fax . ";" . $badge . ";";
				file_put_contents("participants.txt",$participantsnew,LOCK_EX);
				echo "<h1>Registration Information Saved</h1>";
				echo "<b>First Name:</b> $fname<br />";
				echo "<b>Last name:</b> $lname<br />";
				echo "<b>Address 1</b> $address1<br />";
				echo "<b>Address 2</b> $address2<br />";
				echo "<b>City: </b> $city<br />";
				echo "<b>State: </b> $state<br />";
				echo "<b>Zip: </b> $zip<br />";
				echo "<b>Phone: </b> $phone<br />";
				echo "<b>Fax: </b> $fax<br />";
				echo "<b>Badge: </b> $badge<br />";
				echo "<b>Username: </b> $login";
				echo "<hr />";
				echo "<p><a href='index.html'>Return to Conference Registration Page</a></p>";
			}
		}
		else{
			echo "<p>Error occurred. Click your browser's back button to return to form.</p>";
			echo "<hr />";
			echo "<p><a href='index.html'>Return to Conference Registration Page</a></p>";
		}//created by george speach
?>
</body>
</html>