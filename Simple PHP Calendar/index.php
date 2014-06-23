<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style.css" />
<title>Lab 7</title>
</head>
<body>

<?php
include_once("calendar.php");
$calendar = new calendar;
//if the form is set this will set the date values using the get method
if(isset($_GET["month"])){
	$dayofmonth = 1;
	$month = $_GET["month"];
	$year = $_GET["year"];
	$nextyear = $year + 1;
	$prevyear = $year - 1;
}
//if the form is not set then this will set the date values using the current date
else{
	$dayofmonth = date("d");
	$month = date("m");
	$year = date("Y");
	$nextyear = $year + 1;
	$prevyear = $year - 1;
}
//if the form is set this will set the date values using the get method
if(isset($_GET["year"])){
	if($_GET["year"] < 1970){
		echo "<CENTER><h3>ERROR: This Calendar only works from 1970-2037.</h3></CENTER>";
		$dayofmonth = 1;
		$month = $_GET["month"];
		$year = 1970;
		$nextyear = $year + 1;
		$prevyear = $year - 1;
	}
	elseif($_GET["year"] > 2037){
		echo "<CENTER><h3>ERROR: This Calendar only works from 1970-2037.</h3></CENTER>";
		$dayofmonth = 1;
		$month = $_GET["month"];
		$year = 2037;
		$nextyear = $year + 1;
		$prevyear = $year - 1;
	}
	else{
		$dayofmonth = 1;
		$month = $_GET["month"];
		$year = $_GET["year"];
		$nextyear = $year + 1;
		$prevyear = $year - 1;
	}
}
//if the form is not set then this will set the date values using the current date
else{
	$dayofmonth = date("d");
	$month = date("m");
	$year = date("Y");
	$nextyear = $year + 1;
	$prevyear = $year - 1;
}
//this will check to make sure the date values are TRUE
if(checkdate($month,$dayofmonth,$year) == TRUE){
	($calendar -> loadCalendar($month,$dayofmonth,$year,$nextyear,$prevyear));
}
//if date values aren't true this error message will echo
else{
	echo "Error loading Calendar";
}
?>

</body>
</html>