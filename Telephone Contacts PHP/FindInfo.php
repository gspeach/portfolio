<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Telephone Directory</title>
</head>
<body>
<?php
if(empty($_GET["fname"]) || empty($_GET["lname"])){
	echo "<p>You must enter a value in each field. Click your browser's Back button to return to the form.</p>";
}
elseif(isset($_GET["fname"]) && isset($_GET["lname"]) && isset($_GET["address"]) && isset($_GET["city"]) && isset($_GET["state"]) && isset($_GET["zip"]) && isset($_GET["phone"])){
	if(empty($_GET["fname"]) || empty($_GET["lname"]) || empty($_GET["address"]) || empty($_GET["city"]) || empty($_GET["state"]) || empty($_GET["zip"]) || empty($_GET["phone"])){
		echo "<p>You must enter a value in each field. Click your browser's Back button to return to the form.</p>";
	}
	else{
		$fname = $_GET["fname"];
		$lname = $_GET["lname"];
		$address = $_GET["address"];
		$city = $_GET["city"];
		if($_GET["state"] == "select"){
			$directory = file_get_contents("directory.txt");
			$directoryarray = explode(",",$directory);
			while(current($directoryarray) !== $fname || next($directoryarray) !== $lname){
				next($directoryarray);
			}
			next($directoryarray);
			next($directoryarray);
			$state = next($directoryarray);
		}
		else{
			$state = $_GET["state"];
		}
		$zip = $_GET["zip"];
		$phone = $_GET["phone"];
		update($fname, $lname, $address, $city, $state, $zip, $phone);
		$directory = file_get_contents("directory.txt");
		$directoryarray = explode(",",$directory);
		//print_r($directoryarray);
		//this checks for the name in the directory
		while(current($directoryarray) !== $fname || next($directoryarray) !== $lname){
			next($directoryarray);
		}
		$address = next($directoryarray);
		$city = next($directoryarray);
		$state = next($directoryarray);
		$zip = next($directoryarray);
		$phone = next($directoryarray);
		printForm($fname, $lname, $address, $city, $state, $zip, $phone);
	}
}
else{
	$fname = $_GET["fname"];
	$lname = $_GET["lname"];
	$fullname = "*," . $fname . "," . $lname;
	$directory = file_get_contents("directory.txt");
	$directoryarray = explode(",",$directory);
	//print_r($directoryarray);
	//this checks for the name in the directory
	if(strpos($directory,$fullname) !== FALSE){
		while(current($directoryarray) !== $fname || next($directoryarray) !== $lname){
			next($directoryarray);
		}
		$address = next($directoryarray);
		$city = next($directoryarray);
		$state = next($directoryarray);
		$zip = next($directoryarray);
		$phone = next($directoryarray);
		printForm($fname, $lname, $address, $city, $state, $zip, $phone);
	}
	else{
		echo "<p>File does not contain the entered name. Click your browser's back button to return to the form.</p>";
	}
}
function printForm($fname, $lname, $address, $city, $state, $zip, $phone){
	echo	"<h1>Update Entry</h1>";
	echo	"<form action='FindInfo.php' method='get'>";
	echo	"<p>First Name <input type='text' name='fname' value='$fname'>Last Name <input type='text' name='lname' value='$lname'></p>";
	echo	"<p>Address <input type='text' name='address' value='$address'>City <input type='text' name='city' value='$city'></p>";
	echo	"<p>State <select name='state' size='1'>";
	echo	"<option value='select'>$state</option>";
	echo	"<option value='Alabama'>Alabama</option>";
	echo	"<option value='Alaska'>Alaska</option>";
	echo	"<option value='Arizona'>Arizona</option>";
	echo	"<option value='Arkansas'>Arkansas</option>";
	echo	"<option value='California'>California</option>";
	echo	"<option value='Colorado'>Colorado</option>";
	echo	"<option value='Connecticut'>Connecticut</option>";
	echo	"<option value='Delaware'>Delaware</option>";
	echo	"<option value='Florida'>Florida</option>";
	echo	"<option value='Georgia'>Georgia</option>";
	echo	"<option value='Hawaii'>Hawaii</option>";
	echo	"<option value='Idaho'>Idaho</option>";
	echo	"<option value='Illinois'>Illinois</option>";
	echo	"<option value='Indiana'>Indiana</option>";
	echo	"<option value='Iowa'>Iowa</option>";
	echo	"<option value='Kansas'>Kansas</option>";
	echo	"<option value='Kentucky'>Kentucky</option>";
	echo	"<option value='Louisiana'>Louisiana</option>";
	echo	"<option value='Maine'>Maine</option>";
	echo	"<option value='Maryland'>Maryland</option>";
	echo	"<option value='Massachusetts'>Massachusetts</option>";
	echo	"<option value='Michigan'>Michigan</option>";
	echo	"<option value='Minnesota'>Minnesota</option>";
	echo	"<option value='Mississippi'>Mississippi</option>";
	echo	"<option value='Missouri'>Missouri</option>";
	echo	"<option value='Montana'>Montana</option>";
	echo	"<option value='Nebraska'>Nebraska</option>";
	echo	"<option value='Nevada'>Nevada</option>";
	echo	"<option value='New Hampshire'>New Hampshire</option>";
	echo	"<option value='New Jersey'>New Jersey</option>";
	echo	"<option value='New Mexico'>New Mexico</option>";
	echo	"<option value='New York'>New York</option>";
	echo	"<option value='North Carolina'>North Carolina</option>";
	echo	"<option value='North Dakota'>North Dakota</option>";
	echo	"<option value='Ohio'>Ohio</option>";
	echo	"<option value='Oklahoma'>Oklahoma</option>";
	echo	"<option value='Oregon'>Oregon</option>";
	echo	"<option value='Pennsylvania'>Pennsylvania</option>";
	echo	"<option value='Rhode Island'>Rhode Island</option>";
	echo	"<option value='South Carolina'>South Carolina</option>";
	echo	"<option value='South Dakota'>South Dakota</option>";
	echo	"<option value='Tennessee'>Tennessee</option>";
	echo	"<option value='Texas'>Texas</option>";
	echo	"<option value='Utah'>Utah</option>";
	echo	"<option value='Vermont'>Vermont</option>";
	echo	"<option value='Virginia'>Virginia</option>";
	echo	"<option value='Washington'>Washington</option>";
	echo	"<option value='West Virginia'>West Virginia</option>";
	echo	"<option value='Wisconsin'>Wisconsin</option>";
	echo	"<option value='Wyoming'>Wyoming</option>";
	echo	"</select>";
	echo	"Zip <input type='text' name='zip' value='$zip'></p>";
	echo	"<p>Phone Number <input type='text' name='phone' value='$phone'></p>";
	echo	"<input type='submit' value='Update Entry'>";
	echo	"</form>";
	echo	"<hr />";
	echo	"<p><a href='Directory.html'>Return to Directory</a></p>";
}
function update($fname, $lname, $address, $city, $state, $zip, $phone){
	$directory = file_get_contents("directory.txt");
	$directoryarray = explode(",",$directory);
	$fnameloc = array_search($fname,$directoryarray);
	$directoryarrayold = array_slice($directoryarray,$fnameloc,7);
	$stringold = implode(",",$directoryarrayold);
	$stringnew = $fname . "," . $lname . "," . $address . "," . $city . "," . $state . "," . $zip . "," . $phone;
	$directorystringnew = str_replace($stringold,$stringnew,$directory);
	file_put_contents("directory.txt",$directorystringnew,LOCK_EX);
	echo "<p>Directory was successfully updated!</p>";
}
?>
</body>
</html>