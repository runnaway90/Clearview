<?
include('login_functions.php');
session_start();
echo 'Wellcome '.$_SESSION['username'].' <a href=logout.php>Log out</a>';
?>