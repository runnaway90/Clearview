<html>
<body>
<?php
echo 'The following code: <br /><br />
<code>

$d=date("D"); <br />
if ($d=="Fri") <br />
  echo "Have a nice weekend!"; <br />
elseif ($d=="Sun") <br />
  echo "Have a nice Sunday!"; <br />
else <br />
  echo "Have a nice day!"; <br /><br />
</code> 
Gives the output: <br /><br /> ';


?>
<?php
$d=date("D");
if ($d=="Fri")
  echo "Have a nice weekend!";
elseif ($d=="Sun")
  echo "Have a nice Sunday!";
else
  echo "Have a nice day!";
?>

</body>
</html>