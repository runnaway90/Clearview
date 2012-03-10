<?	function validateUser()	{		session_regenerate_id (); //this is a security measure		$_SESSION['valid'] = 1;		//$_SESSION['username'] = $username;	}     
	function isLoggedIn()	{		if(isset($_SESSION['valid']) && $_SESSION['valid'])			return true;		return false;	}
	function logout()	{		$_SESSION = array(); //destroy all of the session variables		session_destroy();		setcookie("clearview_user", NULL, time()-3600);		setcookie("clearview_pass", NULL, time()-3600); 	}
	//make sure that the data is protected from code injection
	function secure_data($data){		$data=trim($data);		$data=htmlspecialchars($data);		$data=mysql_real_escape_string($data);		return $data;	}?>