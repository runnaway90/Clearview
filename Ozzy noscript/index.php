<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="description" content="Clearview is a platform for bla bla blas" />
    <meta name="keywords" content="student, societies, Edinburgh" />
    <title>Clearview | some page | maria | and stuff| cookies do not rule so much!!!!	</title> 
    <link rel="stylesheet" href="style.css" type="text/css" />
    <?php		// sample comment
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
        <div>Hello, temp!</div>
    </div>

    <!-- HEADER START -->
    <div id="header">		<div id="home">		I LOOOOOVE COOKIES!!  me too!!!!!!		vERRY MUVCJ!!! <3	</div>
    

      <div id="home">
        <a href="index.php" tabindex="20">Homeless</a>
<<<<<<< HEAD
      </div>
      
<<<<<<< HEAD
      <div id="pers Maria lalala">
=======
      <div id="pers" class="bla">
>>>>>>> 18766f09b1e6d96a741716b59da239b7710bf6b5
        <?php 
          if (!isset($_GET['l'])) { 
            if ($_GET['l'] != 'pers Maria') {
              include 'books.phpp';
=======
      </div>  
      <div id="pers" class="bla">
        <?php 
          if (isset($_GET['l'])) { 
            if ($_GET['l'] != 'autopers') {
              include 'booksstufff.php';
>>>>>>> 6f17089c556b3614dc5fb15b8fe9fbf2e46f6ef6
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
            <input id="search" type="image" src="glass.png" alt="GO" tabindex="13" />
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