<?php
session_start();

if (!isset($_SESSION['adminid'])){
header("Location: ./index.php");
}


?>
<a href="../index.php" style="margin: 10px; text-decoration:none;"> Home</a>
<a href="adminusers.php" style="margin: 10px; text-decoration:none;"> Users </a>
<a href="adminproducts.php" style="margin: 10px; text-decoration:none;"> Products </a>
<a href="adminorders.php" style="margin: 10px; text-decoration:none;"> Orders </a>
<a href="../logout.php" style="margin: 10px; text-decoration:none;"> Logout </a>