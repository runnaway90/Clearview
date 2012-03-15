<?php 
	include 'database/db_config.php'; // path from index.php
	$conn = mysql_connect($dbhost, $dbuser, $dbpass);
	mysql_select_db($dbname, $conn);
	// get society_id
	$query = "SELECT society_id
			  FROM $usertable
			  WHERE username = '".$_SESSION['username']."';";
	$result = mysql_query($query); 
	$result_arr = mysql_fetch_array($result);
	
	if (empty($result_arr)) {$society_id = 0; $society_name = 'NO SOCIETY';}
	else
	{
		$society_id = $result_arr[0];
	
		//get society_name
		$query = "SELECT name
				  FROM $societytable
				  WHERE id = '$society_id';";
		$result = mysql_query($query);
		$result_arr = mysql_fetch_array($result);
	
		if (empty ($result_arr)) $society_name = '';
		else $society_name = $result_arr[0];
	}
	$society_id_valid = TRUE;				// see if society_id != 0 -- so that is admin of a society
	$society_exists = TRUE;	
	$name_not_empty = TRUE;	
	$name_valid = TRUE;						// not more than 100 chars
	$description_not_empty = TRUE;
	$description_valid = TRUE;				//not more than 50 words
	$time_not_empty = TRUE;
	$time_valid = TRUE;						//is it in a valid date/time format
	$place_not_empty = TRUE;
	$place_valid = TRUE;					// not more than 100 chars	
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
	
	if (isset($_POST['name']))
	{
		$name = $_POST['name'];
		//$description = $_POST['description'];
		$time = $_POST['time'];
		$place = $_POST['place'];
		
		//no point I think
		if (!empty($_POST['description'])) $description = $_POST['description'];
		else $description = shorten_string($description, 50); 
		
		
		
		
		// CHECKING INPUT DATA :::::::
		
			// check if title is empty
			if (empty($name)) $name_not_empty = FALSE;
			
			// check is title is valid < 140 chars
			if (strlen($name) > 100) $name_valid = FALSE;
			
			//privacy_level is empty
			if (empty($description_not_empty)) $description_not_empty = FALSE;
			
			//time is empty
			if (empty($time)) $time_not_empty = FALSE;
			
			// time is valid
			//add the validation of the date or calendar here
			
			
			// society is not valid && society exists
			if ($society_id == 0) $society_id_valid = FALSE;
			else
			{
				if (empty($society_name)) $society_exists = FALSE;  
			}
			
			//available places not empty
			if (empty($place)) $place_not_empty = FALSE;
			
			//available places integer positive
			if (strlen($place) > 100) $name_valid = FALSE;
		
		
		
		// END OF CHECKING INPUT DATA ::::::::
		
		if ($name_not_empty == TRUE &&	
			$name_valid == TRUE && 
			$description_not_empty == TRUE &&
			$place_not_empty == TRUE &&
			$description_valid == TRUE &&
			$place_valid == TRUE &&
			$society_id_valid == TRUE && 
			$society_exists == TRUE && 
			$time_not_empty == TRUE &&  	
			$time_valid == TRUE
			)
		{
			echo $name_empty.$name_valid;
			$query = "INSERT INTO $albumtable ( name, description, time, place, society_id)
					VALUES ('$name' , '$description' , '$time', '$place', '$society_id');";
			mysql_query($query);
		}
	}
?>
<p> 

You are creating an event for <? echo $society_name; ?>

</p>

<p>
Add an album:
	<?php // error messages if any ?>
		<? echo $time;?>
		<? if ($name_not_empty == FALSE) echo '<font color="red">Please enter title</font><br />'; ?>
		<? if ($name_valid == FALSE) echo '<font color="red">Please enter valid title</font><br />'; ?>
		<? if ($description_not_empty == FALSE) echo '<font color="red">Please enter privacy level</font><br />'; ?>
		<? if ($place_not_empty == FALSE) echo '<font color="red">Please enter price</font><br />'; ?>
		<? if ($place_valid == FALSE) echo '<font color="red">Please enter valid price</font><br />'; ?>
		<? if ($description_valid == FALSE) echo '<font color="red">Please enter valid body</font><br />'; ?>
		<? if ($society_id_valid == FALSE) echo '<font color="red">Please enter valid society_id</font><br />'; ?>
		<? if ($society_exists == FALSE) echo '<font color="red">I am sorry but the society you are admin does not exist. Please contact webmaster!</font><br />'; ?>
		<? if ($time_not_empty == FALSE) echo '<font color="red">Please enter the number of available places</font><br />'; ?>
		<? if ($time_valid == FALSE) echo '<font color="red">Please enter valid number of available places > 0 and integer</font><br />'; ?>
			<?php //end of error messages ?>

<form action="index.php?l=add_album" method="POST">
	Album name:  <input type="text" id="name" name="name" value="<? if(isset($name)) echo $name; ?>"> <br /><br />
    Description:  <input type="text" id="description" name="description" value="<? if(isset($description)) echo $description; ?>"> <br /><br />
    Time:  <input type="text" id="time" name="time" value="<? if(isset($time)) echo $time; ?>"> <br /><br />
    Place: <input type="text" id="place" name="place" value="<? if(isset($place)) echo $place; ?>"> <br /><br />
   <input type="submit" value="Submit"><br /><br />

</form>

</p>