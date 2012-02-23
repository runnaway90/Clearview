<html>

<title>
	php problem 3
</title>

<body>

<?php 
	
	function find_divisors($number){
		$divisors = array();
		$number_sqrt = sqrt($number);
		for ($i = 1; $i <= $number_sqrt; $i++)
			if ($number % $i == 0)
				array_push($divisors, $i, ($number/$i));
		return $divisors;
	}
	
	function print_array($array){
		for ($i = 0; $i < count($array)-1; $i++) // you can use count or sizeof($array)
			echo "$array[$i],";
		echo $array[count($array)-1];
	}
	
	$divs = find_divisors(720);
	print_array($divs);
	
?>

</body>

</html>