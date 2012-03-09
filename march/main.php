<?phperror_reporting(E_ALL ^ E_NOTICE); // Error report notice OFFrequire_once('login/db_config.php');$conn = mysql_connect($dbhost, $dbuser, $dbpass);mysql_select_db($dbname, $conn);session_start();require_once('login/login_functions.php');if (!isLoggedIn()) {     function userBox() {        echo 'Please <a href="login/login.php">login</a>';    }}else { // is logged in    $username = $_SESSION['username'];    $query = "SELECT membership_status_id              FROM $usertable              WHERE username = '$username';";    $result = mysql_query($query);    $result_arr = mysql_fetch_array($result);    $membership_status_id = $result_arr[0];        if (isset($_GET['a'])) {      if ($_GET['a'] == 0) { $_SESSION['admin'] = 0; }      else if ($_GET['a'] == 1) { $_SESSION['admin'] = 1; }    }        function userBox() {        echo 'Hello, '.$_SESSION['username'].'!';        echo ' '.'<a href="login/logout.php">Logout</a>';        if ($membership_status_id == $mem_status_admin) {            if ($_SESSION['admin'] == 1) { // admin view                echo ' '.'<a href="main.php?a=0">go to user view</a>';            }            else {              // user view                echo ' '.'<a href="main.php?a=1">go to admin view</a>';            }        }    }}if ( ($_SESSION['admin'] == 1) &&         $membership_status_id == $mem_status_admin) { // admin view    $tab1_link = 'main.php';    $tab2_link = 'main.php?l=pers';    $tab3_link = 'main.php';    $tab1_title = 'Admin home';    $tab2_title = 'Admin tasks';    if (isset($_GET['l'])) { // second tab      if ($_GET['l']=='pers') {        function showTitle() { echo 'admin2'; }        function showContent () { include 'admin2.php'; }        $selStyle = '#pers';      }    }    else if (isset($_GET['q'])) { // search view      function showTitle() { echo 'search admin'; }      function showContent () {        $query = $_GET['q'];        include 'search_admin.php';      }      $selStyle = '#find';    }    else {                      // first tab      function showTitle() { echo 'admin1'; }      function showContent () { include 'admin1.php'; }      $selStyle = '#home';    }}else {    $tab1_link = 'main.php';    $tab2_link = 'main.php?l=pers';    $tab3_link = 'main.php';    $tab1_title = 'Home';    $tab2_title = 'Personal';    if (isset($_GET['l'])) {      if ($_GET['l']=='pers') { // personal page        function showTitle() { echo 'personal'; }        function showContent () { include 'pers.php'; }        $selStyle = '#pers';      }    }    else if (isset($_GET['q'])) {      function showTitle() { echo 'search'; }      function showContent () { // search        $query = $_GET['q'];        include 'search.php';      }      $selStyle = '#find';    }    else {                      // home      function showTitle() { echo 'HOME'; }      function showContent () { include 'home.php'; }      $selStyle = '#home';    }}?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="description" content="Clearview is a platform for bla bla blas" />
    <meta name="keywords" content="student, societies, Edinburgh" />
    <title>Clearview <?php showTitle(); ?></title> 
    <link rel="stylesheet" href="style.css" type="text/css" />    <script type="text/javascript" src="script.js"></script>    <style type="text/css">        <?php echo $selStyle; ?> { background-color: #DDCCAA; }    </style>
  </head>
  <body>    <div id="userBox"> 
        <div> <?php userBox(); ?> </div>
    </div>

    <!-- HEADER START -->
    <div id="header">      <div id="home">        <a href="<?php echo $tab1_link; ?>" tabindex="10">          <?php echo $tab1_title; ?>        </a>      </div>
      <div id="pers">        <?php include 'books.php'; ?>
        <a href="<?php echo $tab2_link; ?>" tabindex="11">          <?php echo $tab2_title; ?>        </a>
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
          <form action="<?php echo $tab3_link; ?>" method="get"><div>
            <input id="q" name="q" type="text" value=
              "<?php echo isset($_GET['q'])?$_GET['q']:'Find...'; ?>" 
            tabindex="12" onfocus="qFocus();" onblur="qBlur();" />
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
</html>
