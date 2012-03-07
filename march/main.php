<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php require_once('login/login_functions.php');session_start();if(isLoggedIn()){?>
<html xmlns="http://www.w3.org/1999/xhtml">

  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="description" content="Clearview is a platform for bla bla blas" />
    <meta name="keywords" content="student, societies, Edinburgh" />
    <title>Clearview | some page</title> 
    <link rel="stylesheet" href="style.css" type="text/css" />
    <?php		error_reporting(E_ALL ^ E_NOTICE); // Error report notice OFF
        		if (isset($_GET['l'])) {
          if ($_GET['l']=='pers') {
            function showContent () {
              include 'books.php';
              include 'pers.php';
            }
            $selStyle = '#pers';
          }
        }
        else if (isset($_GET['q'])) {
          function showContent () {
            $query = $_GET['q'];
            include 'search.php';
          }
          $selStyle = '#find';
        }
        else if (isset($_GET['f'])) {
          function showContent () {
            $filter = $_GET['f'];
            include 'search.php';
          }
          $selStyle = '#find';
        }
        else {
          function showContent () {
            include 'home.php';
          }
          $selStyle = '#home';
        }
      ?>
      <style type="text/css">
        <?php echo $selStyle; ?> { 
          background-color: #DDCCAA; 
        }
      </style>
  </head>
  
  <body>
    
    <div id="userBox"> 
        <div>Hello, 				<? session_start();		echo $_SESSION['username'] ?>!</div>		<a href="login/logout.php">Logout</a>
    </div>

    <!-- HEADER START -->
    <div id="header">
    
      <div id="home">
        <a href="index.php" tabindex="10">Home</a>
      </div>
      
      <div id="pers">
        <?php 
          if (!isset($_GET['l'])) { 
            if ($_GET['l'] != 'pers') {
              include 'books.php';
            }
          }
        ?>
        <a href="index.php?l=pers" tabindex="11">Personal</a>
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
          <form action="index.php" method="get"><div>
            <input id="q" name="q" type="text" value=
              "<?php echo isset($_GET['q'])?$_GET['q']:'Find...'; ?>" 
            tabindex="12" />
            <button id="reset" type="reset" value="X"></button>
            <button id="search" type="submit" value="GO" tabindex="13"></button>
          </div></form>
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
    </div>
    
  </body>
  
</html><?php}else {header ('Location: intro.php');}