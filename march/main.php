<?php	error_reporting(E_ALL ^ E_NOTICE); // Error report notice OFF	require_once('database/db_config.php');	$conn = mysql_connect($dbhost, $dbuser, $dbpass);	mysql_select_db($dbname, $conn);	session_start();	require_once('login/login_functions.php');	if (!isLoggedIn()) 	{ 		function userBox() 		{			echo 'Please <a href="login/login.php">login</a>';		}	}	else { // is logged in		$username = $_SESSION['username'];		$query = "SELECT membership_status_id				  FROM $usertable				  WHERE username = '$username';";		$result = mysql_query($query);		$result_arr = mysql_fetch_array($result);		$isAdmin = $result_arr[0] == $mem_status_admin;				if ($isAdmin && isset($_GET['a']))  // change view		{		  if ($_GET['a'] == 0) { $_SESSION['adminview']=false; }		  else if ($_GET['a'] == 1) { $_SESSION['adminview']=true; }		}				if ($isAdmin) 		{		  function userBox() 		  {			echo 'Hello, '.$_SESSION['username'].'!';			echo ' '.'<a href="login/logout.php">Logout</a>';			if ($_SESSION['adminview'])  // admin view			{				echo ' '.'<a href="main.php?a=0">go to user view</a>';			}			else               // user view			{				echo ' '.'<a href="main.php?a=1">go to admin view</a>';			}		  }		}		else 		{		  function userBox() 		  {			  echo 'Hello, '.$_SESSION['username'].'!';			  echo ' '.'<a href="login/logout.php">Logout</a>';		  }		}	}	if ( $_SESSION['adminview'] && $isAdmin)  // admin view	{		$tab1_link = 'main.php';		$tab2_link = 'main.php?l=pers';		$tab3_link = 'main.php';		$tab1_title = 'Admin home';		$tab2_title = 'Notifications';		if (isset($_GET['l'])) // specific page requested		{			if ($_GET['l']=='pers') // second tab			{				function showTitle() { echo 'admin notifications'; }				function showContent () { include 'admin/pers.php'; }				$selStyle = '#pers';			}            else if ($_GET['l']=='soc_page')             {                function showTitle() { echo 'soc page'; }                function showContent() { include 'admin/soc_page.php'; }            }            else if ($_GET['l']=='soc_events')            {                function showTitle() { echo 'soc events page'; }                function showContent() { $load=1; include 'admin/soc_edit.php'; }            }             else if ($_GET['l']=='add_event')            {                function showTitle() { echo 'soc events page'; }                function showContent() { include 'admin/add_event.php'; }            }             else if ($_GET['l']=='soc_albums')            {                function showTitle() { echo 'soc photos page'; }                function showContent() { $load=2; include 'admin/soc_edit.php'; }            }            else if ($_GET['l']=='soc_blog')            {                function showTitle() { echo 'soc blog page'; }                function showContent() { $load=3; include 'admin/soc_edit.php'; }            }            else if ($_GET['l']=='soc_members')            {                function showTitle() { echo 'soc members page'; }                function showContent() { include 'admin/soc_members.php'; }            }            else if ($_GET['l']=='soc_settings')            {                function showTitle() { echo 'soc settings page'; }                function showContent() { include 'admin/soc_settings.php'; }            }            else             {                function showTitle() { echo 'admin home'; }                function showContent () { include 'admin/home.php'; }                $selStyle = '#home';            }		}		else if (isset($_GET['q']))  // search view		{			function showTitle() { echo 'admin search'; }			function showContent () 			{				$query = $_GET['q'];				include 'admin/search.php';			}			$selStyle = '#find';		}		else 		{                      // first tab			function showTitle() { echo 'admin home'; }			function showContent () { include 'admin/home.php'; }			$selStyle = '#home';		}	}	else 	{		$tab1_link = 'main.php';		$tab2_link = 'main.php?l=pers';		$tab3_link = 'main.php';		$tab1_title = 'Home';		$tab2_title = 'Personal';		if (isset($_GET['l'])) 		{			if ($_GET['l']=='pers') 			{ 						// personal page				function showTitle() { echo 'personal'; }				function showContent() { include 'user/pers.php'; }				$selStyle = '#pers';			}		}		else if (isset($_GET['q'])) 		{			function showTitle() { echo 'search'; }			function showContent () 			{						 // search				$query = $_GET['q'];				include 'user/search.php';			}			$selStyle = '#find';		}		else 		{		                      // home			function showTitle() { echo 'HOME'; }			function showContent () { include 'user/home.php'; }			$selStyle = '#home';		}	}?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="Clearview is a platform for bla bla blas" />
		<meta name="keywords" content="student, societies, Edinburgh" />
		<title>Clearview <?php showTitle(); ?></title> 
		<link rel="stylesheet" href="styles/style.css" type="text/css" />				<style type="text/css"><?php                 if (isset($selStyle))                    echo $selStyle.'{ background-color: #DDCCAA; }';         ?></style>
	</head>
	<body>		<div id="userBox"> 
			<div> <?php userBox(); ?> </div>
		</div>
		<!-- HEADER START -->
		<div id="header">			<div id="home">                <? if ($_SESSION['adminview']) { include 'admin/menu.php'; } ?>				<a href="<?php echo $tab1_link; ?>" tabindex="10">  					<?php echo $tab1_title; ?>				</a>			</div>			
			<div id="pers">				<?php                     if ($_SESSION['adminview']) { include 'admin/books.php'; }                    else { include 'user/books.php'; }                 ?>
				<a href="<?php echo $tab2_link; ?>" tabindex="11">					<?php echo $tab2_title; ?>				</a>
			</div>	 
			<div id="find">
				<div id="browses">
					<div>
						<span>Browse all: </span>
						<button type="button" class="butt">Societies</button>
						<button type="button" class="butt">Articles</button>
						<button type="button" class="butt">Events</button>
						<button type="button" class="butt">Photos</button>
						<button type="button" class="butt">Venues</button>
					</div>
				</div>
				<form action="<?php echo $tab3_link; ?>" method="get">				<div>
					<input id="q" name="q" type="text" value=
						"<?php echo isset($_GET['q'])?$_GET['q']:'Find...'; ?>" 						tabindex="12" onfocus="qFocus();" onblur="qBlur();" />
					<button id="reset" type="reset" value="X"></button>
					<button id="search" type="submit" value="GO" tabindex="13"></button>
				</div>				</form>
			</div>
		</div>
		<!-- HEADER END -->		
		<div id="content">
		  <?php showContent(); ?>
		</div>		
		<div id="footer">
		  <div>
			Copyright the Clearview team
			<a href="http://validator.w3.org/check?uri=referer"><img id="validate-xhtml" src="http://www.w3.org/Icons/valid-xhtml10" alt="Valid XHTML 1.0 Strict" height="31" width="88" /></a>
		  </div>
		</div>                                <!-- Javascript at the bottom to make page load faster -->        <script type="text/javascript" src="scripts/script.js"></script>		<script type="text/javascript" src="scripts/jquery.js"></script>
	</body>
</html>