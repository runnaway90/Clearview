<html>

<title>
	php problem 1
</title>

<body>

<?php 
	
	function leap_yr($year){
		if ($year % 400 == 0){
			echo "The year ".$year." is a leap year<br/>";
		}
		else if ($year % 100 == 0){
			echo "The year ".$year." is NOT a leap year<br/>";
		}
		else if ($year % 4 == 0){
			echo "The year ".$year." is a leap year<br/>";
		}
		else	
			echo "The year ".$year." is NOT a leap year<br/>";
	}
	
	for ($i = 0; $i <= 1000; $i++)
		leap_yr($i);


?>

</body>

</html>