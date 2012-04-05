<?php 
	include 'database/db_config.php';
	
	$title_not_empty = TRUE;	
	$title_valid = TRUE; 					// not more than 140 chars
	$privacy_level_not_empty = TRUE; 		
	$price_not_empty = TRUE;				
	$price_valid = TRUE;					// numerical data >= 0 
	$body_valid = TRUE;						// don't know what tests to do so it is secure
	$society_id_valid = TRUE;				// see if society_id != 0 -- so that is admin of a society
	$society_exists = TRUE;					// if society of which is admin exists
	$available_places_not_empty = TRUE; 	
	$available_places_valid = TRUE;			// check if numerical data > 0 
	$end_time_valid = TRUE;					// end time after start time  --- don't know how to check yet, need form 
	$place_valid = TRUE;					// check if < 200 chars -- don't know how to check yet, need form 
	// need to create a consistent useful calendar choose date to use in register and everywhere else
	
	function shorten_string($string, $wordsreturned)
	{
		$retval = $string;     				// Just in case of a problem
		 
		$array = explode(" ", $string);
		if (count($array) > $wordsreturned) 	// Need to chop of some words
		{
			array_splice($array, $wordsreturned);
			$retval = implode(" ", $array)." ...";
		}
		return $retval;
	}
	
	if (isset($_POST['title']))
	{
		$title = $_POST['title'];
		$privacy_level = $_POST['privacy_level'];
		$price = $_POST['price'];
		$description = $_POST['description'];
		
		if (!empty($_POST['short_description'])) $short_description = $_POST['short_description']; 
		else $short_description = shorten_string($description, 30); 
		
		if (!empty($_POST['long_description'])) $long_description = $_POST['long_description'];
		else $long_description = shorten_string($description, 60); 
	
		$available_places = $_POST['available_places'];
		$online_booking = $_POST['online_booking']; 
		
		echo '<h1>'.$online_booking.'</h1>';
		
		
		
		// CHECKING INPUT DATA :::::::
		
			// check if title is empty
			if (empty($title)) $title_not_empty = FALSE;
			
			// check is title is valid < 140 chars
			if (strlen($title) > 140) $title_valid = FALSE;
			
			//privacy_level is empty
			if (empty($privacy_level_not_empty)) $privacy_level_not_empty = FALSE;
			
			//price is empty
			if (empty($price)) $price_not_empty = FALSE;
			
			// price is numerical
			if (!is_numeric($price) || $price < 0) $price_valid = FALSE;
			
			// body is valid 
			// don't know what to test
			
			// society is not valid && society exists
			if ($society_id == 0) $society_id_valid = FALSE;
			else
			{
				if (empty($society_name)) $society_exists = FALSE;  
			}
			
			//available places not empty
			if (empty($available_places)) $available_places_not_empty = FALSE;
			
			//available places integer positive
			if (!is_numeric($available_places) || $available_places < 1 || 
				$available_places != round($available_places)) $available_places_valid = FALSE;
		
		
		
		// END OF CHECKING INPUT DATA ::::::::
		
		if ($title_not_empty == TRUE &&	
			$title_valid == TRUE && 
			$privacy_level_not_empty == TRUE &&
			$price_not_empty == TRUE &&
			$price_valid == TRUE &&
			$body_valid == TRUE &&
			$society_id_valid == TRUE && 
			$society_exists == TRUE && 
			$available_places_not_empty == TRUE &&  	
			$available_places_valid == TRUE &&
			$end_time_valid == TRUE &&
			$place_valid == TRUE)
		{
			echo $title_not_empty.$title_valid;
			$query = "INSERT INTO $eventtable ( society_id, title, privacy_level, price, body, short_description, long_description, online_booking )
					VALUES ( '$society_id', '$title' , '$privacy_level' , '$price', '$description', '$short_description', '$long_description', '$online_booking' );";
			mysql_query($query);
		}
	}
?>
<p> 
<?php 
    if (isset($society_name)) echo 'You are an admin of the society: '.$society_name; 
    else echo 'You are not an admin of any society.';
?>

</p>

<p>
Add an event:
	<?php // error messages if any ?>
		<? if ($title_not_empty == FALSE) echo '<font color="red">Please enter title</font><br />'; ?>
		<? if ($title_valid == FALSE) echo '<font color="red">Please enter valid title</font><br />'; ?>
		<? if ($privacy_level_not_empty == FALSE) echo '<font color="red">Please enter privacy level</font><br />'; ?>
		<? if ($price_not_empty == FALSE) echo '<font color="red">Please enter price</font><br />'; ?>
		<? if ($price_valid == FALSE) echo '<font color="red">Please enter valid price</font><br />'; ?>
		<? if ($body_valid == FALSE) echo '<font color="red">Please enter valid body</font><br />'; ?>
		<? if ($society_id_valid == FALSE) echo '<font color="red">Please enter valid society_id</font><br />'; ?>
		<? if ($society_exists == FALSE) echo '<font color="red">I am sorry but the society you are admin does not exist. Please contact webmaster!</font><br />'; ?>
		<? if ($available_places_not_empty == FALSE) echo '<font color="red">Please enter the number of available places</font><br />'; ?>
		<? if ($available_places_valid == FALSE) echo '<font color="red">Please enter valid number of available places > 0 and integer</font><br />'; ?>
		<? if ($end_time_valid == FALSE) echo '<font color="red">Please enter valid end date</font><br />'; ?>
		<? if ($place_valid == FALSE) echo '<font color="red">Please enter valid place</font><br />'; ?>
	<?php //end of error messages ?>

<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
    Event title:  <input type="text" id="title" name="title" value="<? if(isset($title)) echo $title; ?>"> <br /><br />
    Privacy level:  <input type="text" id="privacy_level" name="privacy_level" value="<? if(isset($privacy_level)) echo $privacy_level; ?>"> <br /><br />
    Price:  <input type="text" id="price" name="price" value="<? if(isset($price)) echo $price; ?>"> <br /><br />
    Decription: <input type="text" id="description" name="description" value="<? if(isset($description)) echo $description; ?>"> <br /><br />
    Short description:  <input type="text" id="short_description" name="short_description" value="<? if(isset($short_description)) echo $short_description; ?>"> <br /><br />
    Long description:  <input type="text" id="long_description" name="long_description" value="<? if (isset($long_description)) echo $long_description; ?>"> <br /><br />
    Available places: <input type= "text" id="available_places" name="available_places" value="<? if (isset($available_places)) echo $available_places; ?>"> <br /><br /> 
	Online booking: <input type="checkbox" id="online_booking" name="online_booking" value=""> <br /><br />
    <input type="submit" value="Submit"><br /><br />

</form>

</p>