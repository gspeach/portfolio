<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Conference Registration</title>
<link rel="stylesheet" type="text/css" href="http://helios.ite.gmu.edu/~gspeach/IT207/style.css" />
</head>
<?php
		if(isset($_GET["login"]) && isset($_GET["password"])){
			if(empty($_GET["login"]) || empty($_GET["password"])){
				echo "<p>Please enter both Username and Password.</p>";
				echo "<hr />";
				echo "<p><a href='index.html'>Return to Conference Registration Page</a></p>";
			}
			else{
				$login = $_GET["login"];
				$password = $_GET["password"];
				$participants = file_get_contents("participants.txt");
				$participantsarray = explode(";",$participants);
				$participantssearch = "*;" . $login . ";" . $password;
				if(strpos($participants,$participantssearch) !== FALSE){
					while(current($participantsarray) !== $login){
						next($participantsarray);
					}
					next($participantsarray);
					$fname = next($participantsarray);
					$lname = next($participantsarray);
					$address1 = next($participantsarray);
					$address2 = next($participantsarray);
					$address = $address1 . " " . $address2;
					$city = next($participantsarray);
					$state = next($participantsarray);
					$zip = next($participantsarray);
					$phone = next($participantsarray);
					$fax = next($participantsarray);
					$badge = next($participantsarray);
					
					$participants2 = fopen("participants.txt","r");
					$line = "";
					$count = 0;
					while(strpos($line,$participantssearch) === FALSE){
						$line = fgets($participants2);
						$count++;
					}
				
					echo "<h1>Registration Information</h1>";
					echo "<table border=1>";
					echo "<tr>";
					echo "<td>First Name</td><td>Last Name</td><td>Address</td><td>City</td><td>State</td><td>Zip Code</td><td>Phone Number</td><td>Fax Number</td><td>Badge Name</td><td>Username</td><td>Password</td><td>Record #</td>";
					echo "</tr>";
					echo "<tr>";
					echo "<td>$fname</td><td>$lname</td><td>$address</td><td>$city</td><td>$state</td><td>$zip</td><td>$phone</td><td>$fax</td><td>$badge</td><td>$login</td><td>$password</td><td>$count</td>";
					echo "</tr>";
					echo "</table>";
					echo "<hr />";
					echo "<p><a href='index.html'>Return to Conference Registration Page</a></p>";
				}
				else{
					echo "<p>Invalid login or password!</p>";
					echo "<hr />";
					echo "<p><a href='index.html'>Return to Conference Registration Page</a></p>";
				}
			}
		}//created by george speach
?>
</body>
</html>