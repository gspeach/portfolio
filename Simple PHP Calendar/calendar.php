<?php
class calendar{
	function loadCalendar($month,$dayofmonth,$year,$nextyear,$prevyear){
		echo "<CENTER><a href = 'index.php'>Today</a> is: " , date("l"),  ", ", date("F"), " ", date("jS"),   " ", date("Y");
		echo "<table class='cal'><tr><th colspan='7'>", date("F", mktime(0,0,0,$month,$dayofmonth,$year)), " ", date("Y", mktime(0,0,0,$month,$dayofmonth,$year)), "</th></tr><tr><td><b>Sunday</b></td><td><b>Monday</b></td><td><b>Tuesday</b></td><td><b>Wednesday</b></td><td><b>Thursday</b></td><td><b>Friday</b></td><td><b>Saturday</b></td></tr>";
			//this for loop creates the calendar table
			for ($x=1; $x <= date("t", mktime(0,0,0,$month,$dayofmonth,$year)); $x++) {
				while($x == 1){//this while loop checks the day of the week the first day of the month starts and creates the proper table structure
					if(date("w", mktime(0,0,0,$month,1,$year)) == 0){//sunday
					}
					elseif(date("w", mktime(0,0,0,$month,1,$year)) == 1){//monday
					echo "<tr><td></td>";
					}
					elseif(date("w", mktime(0,0,0,$month,1,$year)) == 2){//tuesday
					echo "<tr><td></td><td></td>";
					}
					elseif(date("w", mktime(0,0,0,$month,1,$year)) == 3){//wednesday
					echo "<tr><td></td><td></td><td></td>";
					}
					elseif(date("w", mktime(0,0,0,$month,1,$year)) == 4){//thursday
					echo "<tr><td></td><td></td><td></td><td></td>";
					}
					elseif(date("w", mktime(0,0,0,$month,1,$year)) == 5){//friday
					echo "<tr><td></td><td></td><td></td><td></td><td></td>";
					}
					else{//saturday
					echo "<tr><td></td><td></td><td></td><td></td><td></td><td></td>";
					}
					break;
				}
				//this loop checks the day of the week that the loop is on and will start a new row
				while(date("w", mktime(0,0,0,$month,$x,$year)) == 0){
					echo "<tr>";
					break;
				}
				echo "<td>$x</td>";//this creates each cell with the proper day
				//this loop checks for the end of the week and closes the table row
				while(date("w", mktime(0,0,0,$month,$x,$year)) == 6){
					echo "</tr>";
					break;
				}
				//this loop starts when the end of the month happens and closes out the table
				while(date("t", mktime(0,0,0,$month,$dayofmonth,$year)) == $x){
					if(date("w", mktime(0,0,0,$month,$x,$year)) == 0){//sunday
					echo "<td></td><td></td><td></td><td></td><td></td><td></td>";
					}
					elseif(date("w", mktime(0,0,0,$month,$x,$year)) == 1){//monday
					echo "<td></td><td></td><td></td><td></td><td></td>";
					}
					elseif(date("w", mktime(0,0,0,$month,$x,$year)) == 2){//tuesday
					echo "<td></td><td></td><td></td><td></td>";
					}
					elseif(date("w", mktime(0,0,0,$month,$x,$year)) == 3){//wednesday
					echo "<td></td><td></td><td></td>";
					}
					elseif(date("w", mktime(0,0,0,$month,$x,$year)) == 4){//thursday
					echo "<td></td><td></td>";
					}
					elseif(date("w", mktime(0,0,0,$month,$x,$year)) == 5){//friday
					echo "<td></td>";
					}
					else{//saturday
					}
					echo "</tr>";
					break;
				}
			}
		//these variables make up the links at the bottom of the calendar
		$jan = "<a href = 'index.php?month=1&year=$year'>Jan.</a>";
		$feb = "<a href = 'index.php?month=2&year=$year'>Feb.</a>";
		$mar = "<a href = 'index.php?month=3&year=$year'>Mar.</a>";
		$apr = "<a href = 'index.php?month=4&year=$year'>Apr.</a>";
		$may = "<a href = 'index.php?month=5&year=$year'>May.</a>";
		$jun = "<a href = 'index.php?month=6&year=$year'>Jun.</a>";
		$jul = "<a href = 'index.php?month=7&year=$year'>Jul.</a>";
		$aug = "<a href = 'index.php?month=8&year=$year'>Aug.</a>";
		$sep = "<a href = 'index.php?month=9&year=$year'>Sep.</a>";
		$oct = "<a href = 'index.php?month=10&year=$year'>Oct.</a>";
		$nov = "<a href = 'index.php?month=11&year=$year'>Nov.</a>";
		$dec = "<a href = 'index.php?month=12&year=$year'>Dec.</a>";
		//these are the dynamic links on the bottom of the page
		echo "<tr><td class='footer'><a href = 'index.php?month=$month&year=$prevyear'>$prevyear</a></td><td colspan='5' class='footer'>$jan | $feb | $mar | $apr | $may | $jun | $jul | $aug | $sep | $oct | $nov | $dec</td><td class='footer'><a href = 'index.php?month=$month&year=$nextyear'>$nextyear</a></td></tr></table></CENTER>";
	}
}
?>