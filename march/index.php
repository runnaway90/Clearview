<?phprequire_once('login/login_functions.php');if (isLoggedIn()) {     header ('Location: intro.php');}else {    header ('Location: main.php');}?>