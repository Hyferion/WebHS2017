<?php session_start();
	if(!isset($_SESSION['userid'])) {
		header("Location: ./login.php");
	}
?>
<!DOCTYPE html>

<html>
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="../css/w3c.css"/>
   <title> Cars & Cars </title>
</head>

<body>
<nav>
	<header style="margin-top: 50px">
	<?php include'navigation.php'; ?>
	<container>
	<?php

	//Abfrage der Nutzer ID vom Login
	$userid = $_SESSION['userid'];

	echo "Hallo User: ".$userid;
	?>
</container>
</header>
</nav>
<footer>
  <?php include'footer.php'; ?>
</footer>
</body>
</html>
