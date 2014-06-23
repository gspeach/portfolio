<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Telephone Directory</title>
</head>
<body>
<?php
$directory = file_get_contents("directory.txt");
if(empty($_GET["fname"]) || empty($_GET["lname"]) || empty($_GET["address"]) || empty($_GET["city"]) || $_GET["state"] == "select" || empty($_GET["zip"]) || empty($_GET["phone"])){
	echo "You must enter a value in each field. Click your browser's Back button to return to the form.";
}
else{
	$fname = $_GET["fname"];
	$lname = $_GET["lname"];
	$address = $_GET["address"];
	$city = $_GET["city"];
	$state = $_GET["state"];
	$zip = $_GET["zip"];
	$phone = $_GET["phone"];

	$directory = file_get_contents("directory.txt");
	$fullname = "*," . $fname . "," . $lname;
	if(strpos($directory,$fullname) !== FALSE){
		echo "<p>This name is already in your contacts! Click your browser's Back button to return to the form.</p>";
	}
	else{
		$directorynew = $directory . ",*," . $fname . "," . $lname . "," . $address . "," . $city . "," . $state . "," . $zip . "," . $phone;
		file_put_contents("directory.txt",$directorynew,LOCK_EX);
		echo "<p>Entry has been successfully added! Click your browser's Back button to return to the form.</p>";
	}	
}
?>
</body>
</html>