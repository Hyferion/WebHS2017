<?php
/**
 * Processes the newsletter registration
 */
require_once 'autoloader.php';
if (!DB::create('localhost:8889', 'root', 'test123', 'carscars')) {
	die("Unable to connect to database [".DB::getInstance()->connect_error."]");
}

$email = '';
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$email = test_input($_POST["email"]);
		$active = 1;

		$res = DB::doQuery("Insert into newsletter_emails(email,active) values('" . $email . "', $active) ");
	}
	else{
		die("error");
	}

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
	header("Location: ./index.php");
?>
