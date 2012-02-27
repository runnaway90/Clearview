<html>

<title>
	php problem 2
</title>

<body>

<?php 
	
	function print_nos($number){
		echo "::::The previous 10 numbers of ".$number." descending::::</br>";
		for ($i = 1; $i <= 10; $i++){
			$x = $number - $i;
			
			if ($x % 2 == 0) echo "The number ".$x." is even</br>";
			else echo "The number ".$x." is odd</br>";
		}
		echo "</br>";
	}
	
	print_nos(100);
	print_nos(120);
	print_nos(160);
	print_nos(200);
?>

</body>

</html>