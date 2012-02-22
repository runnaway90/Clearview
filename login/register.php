<?
require_once('db_config.php');
require_once('login_functions.php');
session_start();


$username_not_empty=TRUE;
$username_valid=TRUE;
$username_not_duplicate=TRUE;
$password_not_empty=TRUE;
$passwords_match=TRUE;
$password_valid=TRUE;
$captcha_valid= TRUE;

//check if user is logged in
if (isLoggedIn()) 
{
header('Location: memberzone.php');
}
//check if username and password fields are not empty
if (isset($_POST['username']) && isset($_POST['pass1']) && $_POST['pass2'])
{

//retrieve our data from POST
$username = ($_POST['username']);
$pass1 = ($_POST['pass1']);
$pass2 = ($_POST['pass2']);

//check if username is not empty
if(empty($username)) {$username_not_empty = FALSE;}
else {$username_not_empty = TRUE;}

//connect to the DB
$conn = mysql_connect($dbhost, $dbuser, $dbpass);
mysql_select_db($dbname, $conn);

//secure data agains code injection
$username = secure_data($_POST['username']);
$pass1 = secure_data($_POST['pass1']);
$pass2 = secure_data($_POST['pass2']);

//check if username is valid
if ((!(ctype_alnum($username))) || ((strlen($username)) >15)) {$username_valid=FALSE;}
else {$username_valid=TRUE;}

//check if user exists
$query = 	"SELECT username
			FROM ".$usertable."
			WHERE username = '$username';";
		$result = mysql_query($query);
		if(mysql_num_rows($result) < 1) //no such user exists
			{
				$username_not_duplicate=TRUE;
			}
		else {$username_not_duplicate=FALSE;}

//check if passwords match
/*if($pass1 != $pass2)
    header('Location: register.php');
if(strlen($username) > 30)
    header('Location: register_form.php');*/
	
//check if password is not empty
if(empty($pass1)) {$password_not_empty = FALSE;}
else {$password_not_empty = TRUE;}	

//check if passwords match
if ($pass1==$pass2) 
{
$passwords_match=TRUE;
} 
else 
{
$passwords_match=FALSE;
}

//check if password is valid	
if
( 
ctype_alnum($pass1) // numbers & digits only 
//&& (strlen($pass1)>6) // at least 7 chars 
//&& (strlen($pass1)<21) // at most 20 chars 
//&& preg_match('`[A-Z]`',$pass1) // at least one upper case 
//&& preg_match('`[a-z]`',$pass1) // at least one lower case 
//&& preg_match('`[0-9]`',$pass1) // at least one digit 
)
{ 
$password_valid=TRUE;
}
else
{
$password_valid=FALSE;
}

//Validate recaptcha
require_once('recaptchalib.php');
$resp = recaptcha_check_answer ($private_captcha_key,
                                $_SERVER["REMOTE_ADDR"],
                                $_POST["recaptcha_challenge_field"],
                                $_POST["recaptcha_response_field"]);

if (!$resp->is_valid) {
//captcha validation fails
$captcha_valid=FALSE;
} else {
$captcha_valid=TRUE;	
}
 
 //check if all variables are true
 if (($username_not_empty==TRUE)
&& ($username_valid==TRUE)
&& ($username_not_duplicate==TRUE)
&& ($password_not_empty==TRUE)
&& ($passwords_match==TRUE)
&& ($password_valid==TRUE)
&& ($captcha_valid==TRUE)) {
 
//hash the password
$hash = hash('sha256', $pass1);
//creates a 3 character sequence
function createSalt()
{
    $string = md5(uniqid(rand(), TRUE));
    return substr($string, 0, 3);
}
$salt = createSalt();
$hash = hash('sha256', $salt . $hash);



$query = "INSERT INTO ".$usertable." ( username, password, salt )
        VALUES ( '$username' , '$hash' , '$salt' );";
mysql_query($query);
mysql_close();
//? No idea where to redirect yet
header('Location: login.php');
exit();
}}



/*
echo '<form name="register" action="register.php" method="post">
    Username: <input type="text" name="username" maxlength="30" />
    Password: <input type="password" name="pass1" />
    Password Again: <input type="password" name="pass2" />
    <input type="submit" value="Register" />
</form>';
*/
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Register as a Valid User</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<style type="text/css">
.invalid {
border: 1px solid #000000;
background: #FF00FF;
}
</style>
</head>
<body >
<h2>User registration Form</h2>
<br />
Please fill in the details below(<i>note that all fields are required</i>)
<br /><br />
<!-- Start of registration form -->
<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
Username:  <input type="text" class="<?php if (($username_not_empty==FALSE) || ($username_valid==FALSE) || ($username_not_duplicate==FALSE))  echo "invalid"; ?>" id="username" name="username"> (<i>alphanumeric less than 14 characters</i>)<br /><br />
Password:  <input name="pass1" type="password" class="<?php if (($password_not_empty==FALSE) || ($passwords_match==FALSE) || ($password_valid==FALSE)) echo "invalid"; ?>" id="pass1" > (<i>alphanumeric greater than 7 characters and less than 20 characters</i>)<br /><br />
Retype password: <input name="pass2" type="password" class="<?php if (($password_not_empty==FALSE) || ($passwords_match==FALSE) || ($password_valid==FALSE)) echo "invalid"; ?>" id="pass2" ><br />
<br /><br />
Type the captcha below:
<br /> <br />
<?php
require_once('recaptchalib.php');
echo recaptcha_get_html($public_captcha_key);
?>
<br /><br />
<input type="submit" value="Register">
<br /><br />
<a href="index.php">Back to Homepage</a><br />
	<? if ($captcha_valid==FALSE) echo '<font color="red">Please enter correct captcha</font><br />'; ?>
	<? if ($username_not_empty==FALSE) echo '<font color="red">You have entered an empty username.</font><br />'; ?>
	<? if ($username_valid==FALSE) echo '<font color="red">Your username should be alphanumeric and less than 14 characters.</font><br />'; ?>
	<? if ($username_not_duplicate==FALSE) echo '<font color="red">Please choose another username, your username is already used.</font><br />'; ?>
	<? if ($password_not_empty==FALSE) echo '<font color="red">Your password is empty.</font><br />'; ?>
	<? if ($passwords_match==FALSE) echo '<font color="red">Your password does not match.</font><br />'; ?>
	<? if ($password_valid==FALSE) echo '<font color="red">Your password should be alphanumeric and greater 7 characters and less than 20 characters.</font><br />'; ?>
	<? //if ($captcha_valid==FALSE) echo '<font color="red">Your captcha is invalid.</font><br />'; ?>
</form>
<!-- End of registration form -->
</body>
</html>
