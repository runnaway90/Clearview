<?
	/*
	to add:
		token security
		ip check in the session
		maybe some other security
		(check)display errors on login form
		captcha check after several unsuccessful attempts
		(check)secure username and password against injection
		(check)make username email
		(check?)remember me
		
	*/
    
	if (!isLoggedIn())
    {
        //validation variables
        $username_not_empty=TRUE;
        // $username_valid is set by check_in.php
        $password_not_empty=TRUE;
        $passwords_match=TRUE;
        $username = '';
		//check if wants to login
		if (isset($_POST['username']) && isset($_POST['password']))
		{
            
            $username = $_POST['username'];
			$password = $_POST['password'];
		
            //secure data agains code injection
			$username = secure_data($username);
			$password = secure_data($password);
			
			//check if username is not empty
			if (empty($username)) { $username_not_empty = FALSE; }
			
			$query = 	"SELECT password, salt
						FROM $usertable
						WHERE username = '$username';";
						
			$query2 = 	"SELECT password, salt, username
						FROM $usertable
						WHERE email = '$username';";			
						
			$result = mysql_query($query);
			$result2 = mysql_query($query2);
			
			//check if username exists		
			if((mysql_num_rows($result) < 1)&&(mysql_num_rows($result2) < 1)) //no such user exists
			{
				$username_valid=FALSE;
			}
			
			//check if password is not empty
			if (empty($password)) { $password_not_empty = FALSE; }
			
			$userData = mysql_fetch_array($result, MYSQL_ASSOC);
			$userData2 = mysql_fetch_array($result2, MYSQL_ASSOC);
			$hash = hash('sha256', $userData['salt'] . hash('sha256', $password) );
			$hash2 = hash('sha256', $userData2['salt'] . hash('sha256', $password) );
			
			//check if passwords match
			if(($hash != $userData['password'])&&($hash2 != $userData2['password'])) //incorrect password
			{
				$passwords_match = FALSE;
			} 
			else if ($hash == $userData2['password'])
			{		
                $username = $userData2['username'];
			}
			
			if (($username_not_empty==TRUE) && 
                ($username_valid==TRUE) && 
                ($password_not_empty==TRUE) && 
                ($passwords_match==TRUE) )
			{	
				$_SESSION['username'] = $username;
				$md5pass = md5($hash);
				validateUser(); //sets the session data for this user
                
                // set user level
				$query = "SELECT membership_status_id
                          FROM $usertable
                          WHERE username = '$username';";
                $result = mysql_query($query);
                $result_arr = mysql_fetch_array($result);
                $_SESSION['userlevel'] = $result_arr[0];
                $isAdmin = $result_arr[0] == $mem_status_admin;
                
				//set remember me cookie for 30 days
				if (isset($_POST["remember"]))
				{
					setcookie("clearview_user", $_SESSION['username'], time() + (60*60*24*30),"/");
					setcookie("clearview_pass", "$md5pass", time() + (60*60*24*30),"/");
				}
			}
            header ('Location: '.htmlentities($_SERVER['PHP_SELF']));
		}
        // then show the form
?>
		<form action="<? echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
			<table>
				<tr><td>Username:</td><td><input type="text" class="<? if (($username_not_empty==FALSE) || ($username_valid==FALSE) )  echo "invalid"; ?>" name="username" value="<? if(isset($username)) echo $username; ?>" /></td></tr>
				<tr><td>Password:</td><td><input type="password" class="<? if (($password_not_empty==FALSE) || ($passwords_match==FALSE) ) echo "invalid"; ?>" name="password" /></td></tr>
				<tr><td></td><td><input type="checkbox" name="remember" /> Remember Me<br /></td></tr>
			</table>
			<input type="hidden" name="token" value="<? echo $token;?>" />
			<input type="submit" name="login" value="Login" />
			
			<!-- Display validation errors -->
			<? if ($username_not_empty==FALSE) echo '<font color="red">You have entered an empty username.</font><br />'; ?>
			<? if (($username_valid==FALSE)&&($username_not_empty==TRUE)) echo '<font color="red">Username does not exist.</font><br />'; ?>
			<? if ($password_not_empty==FALSE) echo '<font color="red">Please enter a password.</font><br />'; ?>
			<? if (($passwords_match==FALSE)&&($username_valid==TRUE)&&($username_not_empty==TRUE)) echo '<font color="red">Incorrect password.</font><br />'; ?>
			
		</form>
		Not Registered yet? <a href = "register.php">Create an account.</a>
		
        
        <?/*<div id="fb-root"></div>
		  <script>
			window.fbAsyncInit = function() {
			  FB.init({
				appId      : '236076533148324',
				status     : true, 
				cookie     : true,
				xfbml      : true,
				oauth      : true,
			  });
			};
			(function(d){
			   var js, id = 'facebook-jssdk'; if (d.getElementById(id)) {return;}
			   js = d.createElement('script'); js.id = id; js.async = true;
			   js.src = "//connect.facebook.net/en_US/all.js";
			   d.getElementsByTagName('head')[0].appendChild(js);
			 }(document));
		  </script>
		  <div class="fb-login-button" data-scope="email,user_checkins">
			Login with Facebook
		  </div>*/?>
	
<?	
	}
?>