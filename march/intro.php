<?/*to add:	token security	ip check in the session	maybe some other security	(check)display errors on login form	captcha check after several unsuccessful attempts	(check)secure username and password against injection	(check)make username email	remember me	*/require_once('login/login_functions.php');require_once('login/db_config.php');session_start(); //must call session_start before using any $_SESSION variables//validation variables$username_not_empty=TRUE;$username_valid=TRUE;$password_not_empty=TRUE;$passwords_match=TRUE;$username = '';if (isLoggedIn()) 	{	header('Location: main.php');	}else	{ 	if (isset($_COOKIE['clearview_user']) && isset($_COOKIE['clearview_pass']))	{	$username = $_COOKIE['clearview_user'];	$conn = mysql_connect($dbhost, $dbuser, $dbpass);	mysql_select_db($dbname, $conn);	$query = 	"SELECT password, username				FROM ".$usertable."				WHERE username = '$username';";	$result = mysql_query($query);	if((mysql_num_rows($result) < 1)) //no such user exists			{				$username_valid=FALSE;			}			else 			{				$userData = mysql_fetch_array($result, MYSQL_ASSOC);				if($userData['username']==$_COOKIE['clearview_user'] && md5($userData['password'])==$_COOKIE['clearview_pass'])				{					$_SESSION['username'] = $userData['username'];					validateUser();					header('Location: main.php');				}			}	//$hash = hash('sha256', $userData['salt'] . hash('sha256', $password) );	}			//check if username and password are set	if (isset($_POST['username']) && isset($_POST['password']))		{		$username = $_POST['username'];		$password = $_POST['password'];			$conn = mysql_connect($dbhost, $dbuser, $dbpass);		mysql_select_db($dbname, $conn);				//secure data agains code injection		$username = secure_data($username);		$password = secure_data($password);				//check if username is not empty		if(empty($username)) {$username_not_empty = FALSE;}		else {$username_not_empty = TRUE;}				$query = 	"SELECT password, salt					FROM ".$usertable."					WHERE username = '$username';";							$query2 = 	"SELECT password, salt, username					FROM ".$usertable."					WHERE email = '$username';";										$result = mysql_query($query);		$result2 = mysql_query($query2);				//check if username exists				if((mysql_num_rows($result) < 1)&&(mysql_num_rows($result2) < 1)) //no such user exists			{			$username_valid=FALSE;			}		else {$username_valid=TRUE;}				//check if password is not empty		if(empty($password)) {$password_not_empty = FALSE;}		else {$password_not_empty = TRUE;}				$userData = mysql_fetch_array($result, MYSQL_ASSOC);		$userData2 = mysql_fetch_array($result2, MYSQL_ASSOC);		$hash = hash('sha256', $userData['salt'] . hash('sha256', $password) );		$hash2 = hash('sha256', $userData2['salt'] . hash('sha256', $password) );		//check if passwords match		if(($hash != $userData['password'])&&($hash2 != $userData2['password'])) //incorrect password		{		$passwords_match=FALSE;		} 		else 		{		if($hash == $userData2['password'])				{			$username = $userData2['username'];		}				$passwords_match=TRUE;		}		if (($username_not_empty==TRUE)			&& ($username_valid==TRUE)				&& ($password_not_empty==TRUE)			&& ($passwords_match==TRUE))			{			$_SESSION['username'] = $username;			//$username = "";			$md5pass = md5($hash);			validateUser(); //sets the session data for this user						//set remember me cookie for 30 days			if (isset($_POST["remember"]))               setcookie("clearview_user", $_SESSION['username'], time() + (60*60*24*30));               setcookie("clearview_pass", "$md5pass", time() + (60*60*24*30));			   			header('Location: main.php');			}							}?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"><html xmlns="http://www.w3.org/1999/xhtml">  <head>    <meta http-equiv="content-type" content="text/html; charset=utf-8" />    <meta name="description" content="Clearview is a platform for bla bla blas" />    <meta name="keywords" content="student, societies, Edinburgh" />    <title>Clearview | some page</title>     <link rel="stylesheet" href="intro.css" type="text/css" />	<script src="jquery.js" type="text/javascript"></script>	<script type="text/javascript">			$(document).ready(function() {				$(".signin").click(function(e) {					e.preventDefault();					$("fieldset#signin_menu").toggle();					$(".signin").toggleClass("menu-open");				});				$("fieldset#signin_menu").mouseup(function() {					return false				});				$(document).mouseup(function(e) {					if($(e.target).parent("a.signin").length==0) {						$(".signin").removeClass("menu-open");						$("fieldset#signin_menu").hide();					}				});            			});	</script>  </head>    <body>      <!--      INTRO PAGE		<a href="login/login.php">Login</a>		        <a href="main.php">Go to main page</a>    -->		<div id="container">  <div id="topnav" class="topnav"> Have an account? <a href="login" class="signin"><span>Sign in</span></a> </div>  <fieldset id="signin_menu">		<form action="<? echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">		<p>		<label for="Username"> Username or email </label>		<input type="text" class="<? if (($username_not_empty==FALSE) || ($username_valid==FALSE) )  echo "invalid"; ?>" name="username" value=<? if(isset($username)) echo '"'.$username.'"'; ?> tabindex="1" />		</p>		<label for="Password"> Password </label>		<input type="password" class="<? if (($password_not_empty==FALSE) || ($passwords_match==FALSE) ) echo "invalid"; ?>" name="password" tabindex="2" />		</p>		<input type="checkbox" name="remember" /> Remember Me<br />	<input type="hidden" name="token" value="<? echo $token;?>" />	<input type="submit" name="login" value="Login" />	<!-- Display validation errors -->	<? if ($username_not_empty==FALSE) echo '<font color="red">You have entered an empty username.</font><br />'; ?>	<? if (($username_valid==FALSE)&&($username_not_empty==TRUE)) echo '<font color="red">Username does not exist.</font><br />'; ?>	<? if ($password_not_empty==FALSE) echo '<font color="red">Please enter a password.</font><br />'; ?>	<? if (($passwords_match==FALSE)&&($username_valid==TRUE)&&($username_not_empty==TRUE)) echo '<font color="red">Incorrect password.</font><br />'; ?>	<? } ?>	</form>	Not Registered yet? <a href = "login/register.php">Create an account.</a>	<br /> 	    <!--<form method="post" id="signin" action="https://twitter.com/sessions">      <label for="username">Username or email</label>      <input id="username" name="username" value="" title="username" tabindex="4" type="text">      </p>      <p>        <label for="password">Password</label>        <input id="password" name="password" value="" title="password" tabindex="5" type="password">      </p>      <p class="remember">        <input id="signin_submit" value="Sign in" tabindex="6" type="submit">        <input id="remember" name="remember_me" value="1" tabindex="7" type="checkbox">        <label for="remember">Remember me</label>      </p>      <p class="forgot"> <a href="#" id="resend_password_link">Forgot your password?</a> </p>      <p class="forgot-username"> <A id=forgot_username_link title="If you remember your password, try logging in with your email" href="#">Forgot your username?</A> </p>    </form> -->		  </fieldset></div>        <a href="main.php">Go to main page</a>  </body>  </html>