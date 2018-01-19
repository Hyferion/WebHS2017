<?php
session_start();

/**
 * WRITE lang to the SESSION so we don't need a GET Parameter
 */
if (isset($_GET['lang'])){
	$_SESSION['lang'] = $_GET['lang'];
	header("Location: ./index.php");
}
?>