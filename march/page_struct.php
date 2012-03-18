<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

	<head>

		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="Clearview is a platform for bla bla blas" />
		<meta name="keywords" content="student, societies, Edinburgh" />
		<title><?php showTitle(); ?></title> 
		<link rel="stylesheet" href="styles/style.css" type="text/css" />
        
	</head>

	<body>
		<div id="header"> 
			<?php showHeader(); ?> 
		</div>

		
		<div id="content">
		  <?php showContent(); ?>
		</div>

		
		<div id="footer">
		  <div>
			Copyright the Clearview team
			<a href="http://validator.w3.org/check?uri=referer"><img id="validate-xhtml" src="http://www.w3.org/Icons/valid-xhtml10" alt="Valid XHTML 1.0 Strict" height="31" width="88" /></a>
		  </div>
		</div>
        
        
        
        <!-- Javascript at the bottom to make page load faster -->
        <script type="text/javascript" src="<? echo $path; ?>scripts/script.js"></script>
		<script type="text/javascript" src="<? echo $path; ?>scripts/jquery.js"></script>
	</body>
</html>
